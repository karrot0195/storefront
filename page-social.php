<?php
require_once __DIR__ . '/libs/Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '2465882220135151',
  'app_secret' => '50bcc64d9038b8b45d2a48d36fe11333',
  'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl(home_url('fb-callback/'), $permissions);

if (isset($_GET['code'])) {
	dd($_GET['code']);
}

header('location: '.$loginUrl);

