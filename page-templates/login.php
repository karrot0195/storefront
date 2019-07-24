<?php
/**
 * Template name: Template Login
 */
if(!session_id()) {
    session_start();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $result = [
        'error' => true,
        'mss' => ''
    ];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $wp_hasher = new PasswordHash(8, TRUE);

    $user = get_user_by('email', $email);
    if ($user && $wp_hasher->CheckPassword($password, $user->data->user_pass)) {
        $result['error'] = false;
        $result['cb'] = '';

        if (isset($_SESSION['callback_url']) && !empty($_SESSION['callback_url'])) {
            $result['cb'] = $_SESSION['callback_url'];
            unset($_SESSION['callback_url']);
        }
        wp_clear_auth_cookie();
        wp_set_current_user ( $user->data->ID );
        wp_set_auth_cookie  ( $user->data->ID );
    } else {
        $result['mss'] = 'Invalid login!';
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if (isset($_GET['cb']) && !empty($_GET['cb'])) {
    $_SESSION['callback_url'] = $_GET['cb'];
}

get_header('home-1'); 
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main login" role="main">
            <div class="container">
                <?php get_breadcrumb();  ?>
                <div class="login-wrapper">
                    <div class="title-tab">
                        <div class="tab login-title tab-click" data-tab="tab-1">Login</div>
                        <div class="tab register-title" data-tab="tab-2">Register</div>
                    </div>
                    <div id="tab-1" class="tab-content-login login current">
                        <div class="login-form">
                            <p class="title">Login</p>
                            <button class="btn-fb" onClick="loginFacebook()">
                                <i class="fab fa-facebook-f"></i>
                                <span>Sign in via Facebook</span>
                            </button>

                            <div class="login-type">
                                <div class="line">
                                </div>
                                <div class="or">
                                    or
                                </div>
                                <div class="line">
                                </div>
                            </div>
                            
                            <div class="email-wrapper">
                                <label>Email Address</label>
                                <input type="text" name="email" id="email" value="" />
                            </div>
                            <div class="password-wrapper">
                                <label>Password</label>
                                <input type="password" name="password" id="password" value="" />
                            </div>
                            <p class="fg-pass">Forgot Password?</p>
                            <button class="btn-login" onClick="loginForm()">Login</button>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-content-login register">
                        <p class="title">Register</p>
                        <button class="btn-register"> Create an Account</button>
                    </div>
                </div>        
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<script type="text/javascript">
    function loginFacebook() {
        window.location = "<?= home_url('social') ?>";
    }

    function loginForm() {
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        if (email && email.length && password && password.length) {
            let formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            let request = new XMLHttpRequest();
            request.responseType = 'json';
            request.onload = function() {
                let json = this.response;
                if (!json.error) {
                    if (json['cb']) {
                        window.location.href = json['cb'];
                    } else {
                        window.location.reload();
                    }
                } else {
                    alert(json.mss);
                }
            };
            request.open("POST", "");
            request.send(formData);
        }
    }
</script>
<?php
get_footer('home-1');
