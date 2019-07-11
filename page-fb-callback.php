<?php
if(!session_id()) {
    session_start();
}

require_once __DIR__ . '/libs/Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '2465882220135151',
  'app_secret' => '50bcc64d9038b8b45d2a48d36fe11333',
  'default_graph_version' => 'v2.10'
]);

if (isset($_GET['code'])) {
	$_SESSION['fb_access_token'] = null;
	$helper = $fb->getRedirectLoginHelper();
	if (isset($_GET['state'])) {
	    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
	}

	try {
	  $accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	if (! isset($accessToken)) {
	  if ($helper->getError()) {
	    header('HTTP/1.0 401 Unauthorized');
	    echo "Error: " . $helper->getError() . "\n";
	    echo "Error Code: " . $helper->getErrorCode() . "\n";
	    echo "Error Reason: " . $helper->getErrorReason() . "\n";
	    echo "Error Description: " . $helper->getErrorDescription() . "\n";
	  } else {
	    header('HTTP/1.0 400 Bad Request');
	    echo 'Bad request';
	  }
	  exit;
	}

	$_SESSION['fb_access_token'] = $accessToken->getValue();
	header('location: ' . home_url('fb-callback'));
	exit();
}

if (!empty($_SESSION['fb_access_token'])) {
	$accessToken = $_SESSION['fb_access_token'];
	$result = $fb->get('/me?fields=id,name,email', $accessToken);
	$user = $result->getGraphUser();
	if (!empty($user)) {
		$facebookId = $user->getId();
		$facebookName = $user->getName();
		$email = $user->getEmail();

	    global $wpdb;

	    $meta_key = 'facebook_id';
	    $meta_value = $facebookId;

	    $query = $wpdb->prepare(
	        "SELECT * FROM $wpdb->usermeta WHERE meta_key = %s and meta_value = %s", $meta_key, $meta_value
	    );

	    $result = $wpdb->get_row( $query );
	    if ($result) {
	        $user_id = $result->user_id;
	        $user = get_user_by( 'id', $user_id );
	        if( $user ) {
	            wp_clear_auth_cookie();
	            wp_set_current_user ( $userId );
	            wp_set_auth_cookie( $user_id );
	        }

	    } else {
	        $pass = 'derma' . $facebookId;

	        $userId = wp_insert_user([
	            'user_login' => $facebookId,
	            'user_pass' => $pass,
	            'user_nicename' => $facebookName,
	            'display_name' => $facebookName,
	            'user_email' => $email,
	        ]);
	        if (!is_wp_error($userId)) {
	            add_user_meta($userId, 'facebook_id', $facebookId, true);
	            // login
	            wp_clear_auth_cookie();
	            wp_set_current_user ( $userId );
	            wp_set_auth_cookie  ( $userId );
	        } else {
	        	$message = $userId->get_error_message();
				header('location: ' . home_url('login') . '?error='.$message);
				exit();	        	
	        }
	    }

		header('location: ' . home_url('my-account'));
		exit();
	}
}

header('location: ' . home_url());
exit();