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
        if (empty($user)) {
            $result['mss'] = 'Email does not exist!';
            $result['field'] = 'email';
        } else {
            $result['mss'] = 'Incorrect password';
            $result['field'] = 'password';
        }
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
                        <div class="wrap-form login-form"> 
                            <div class="email-wrapper wrap-field">
                                <label>Email Address</label>
                                <input type="text" name="email" id="email" value="" />
                                <span class="error"></span>
                            </div>
                            <div class="password-wrapper wrap-field">
                                <label>Password</label>
                                <input type="password" name="password" id="password" value="" />
                                <span class="error"></span>
                            </div>
                            <p class="fg-pass js-switch-from" data-form="forgot-form" style="cursor: pointer;">Forgot Password?</p>
                            <button class="btn-login" onClick="loginForm()">Login</button>
                        </div>


                        <div class="wrap-form forgot-form">
                            <div class="email-wrapper">
                                <label>Email Address</label>
                                <input type="text" name="email" id="fg-email" value="" />
                            </div>
                            <p class="fg-pass js-switch-from" data-form="login-form" style="cursor: pointer;">Login Form?</p>
                            <div class="button-wrap">
                                <button class="btn-forgot" onClick="forgotForm()">
                                    <span>Submit</span>
                                    <i class="fas fa-spinner fa-spin"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-content-login register">
                        <p class="title">Register</p>
                        <div class="wrap-create-account js-wrap-form-register">
                            <div class="wrap-register-message error"></div>

                            <div class="wrap-field email-wrapper">
                                <label>Email Address</label>
                                <input type="text" name="email" id="reg-email" value="" />
                                <span class="error"></span>
                            </div>
                            <div class="wrap-field password-wrapper">
                                <label>Password</label>
                                <input type="password" name="password" id="reg-password" value="" />
                                <span class="error"></span>
                            </div>

                            <div class="wrap-field password-wrapper">
                                <label>Confirm Password</label>
                                <input type="password" name="repassword" id="reg-repassword" value="" />
                                <span class="error"></span>
                            </div>

                            <div class="button-wrap">
                                <button class="btn-create-account js-btn-create-account">
                                    <span>Create</span>
                                    <i class="fas fa-spinner fa-spin"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn-register js-btn-register"> Create an Account</button>
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
        let email = document.getElementById('email').value.toLocaleLowerCase();
        let password = document.getElementById('password').value;
        if (email && email.length && password && password.length) {
            let formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            let request = new XMLHttpRequest();
            request.responseType = 'json';
            
            request.onload = function() {
                let json = this.response;
                console.log(json);
                if (!json.error) {
                    if (json['cb']) {
                        window.location.href = json['cb'];
                    }
                } else { 
                    if (json['field']) {
                        jQuery(`.login-form .wrap-field .error`).html('');
                        jQuery(`.login-form .${json['field']}-wrapper .error`).html(json['mss']);
                    } else {
                        alert(json['mss']);
                    }
                }
            };
            request.open("POST", "");
            request.send(formData);
        }
    }

    function forgotForm() {
        let email = jQuery('#fg-email').val().toLocaleLowerCase();
        if (email.trim().length > 0) {
            jQuery('.btn-forgot').addClass('proccessing');
            jQuery.post(my_ajax_object.ajax_url, {
                    email: email,
                    action: 'action_forgot_password'
            }, function (json) {
              if (json.error) {
                    alert(json.message);
                } else {
                    alert('Complete! Please check your email');
                    window.location.reload();
                }

                jQuery('.btn-forgot').removeClass('proccessing');
            });
        }
    }

    (function($) {
        $('.js-btn-register').on('click', function () {
            $('.js-wrap-form-register').toggle();
            $(this).hide();
        });

        $('.js-switch-from').on('click', function () {
            let formClass = $(this).data('form');

            $(this).parents('.wrap-form').hide();
            $('.'+formClass).show();
        });

        $('.js-btn-create-account').on('click', function() {
            let eEmail = $('#reg-email');
            let ePass = $('#reg-password');
            let eRepass = $('#reg-repassword');

            const email = eEmail.val().toLocaleLowerCase();
            const password = ePass.val();
            const repassword = eRepass.val();

            let error = false;
            if (email.trim().length == 0) {
                eEmail.parent().find('.error').html('This field is required');
                error = true;
            } else {
                eEmail.parent().find('.error').html('');
            }

            if (password.trim().length == 0) {
                ePass.parent().find('.error').html('This field is required');
                error = true;
            } else {
                ePass.parent().find('.error').html('');

            }

            if (repassword.trim().length == 0) {
                eRepass.parent().find('.error').html('This field is required');
                error = true;
            } else {
                eRepass.parent().find('.error').html('');
            }

            if (!error) {
                if (password != repassword) {
                    eRepass.parent().find('.error').html('This field do not match');
                    error = true;
                }
            }

            if (!error) {
                $('.wrap-create-account').addClass('proccessing');
                $.post(my_ajax_object.ajax_url, 
                    {
                        email: email,
                        password: password,
                        action: 'action_create_account'
                    }
                , function (json) {
                   setTimeout(function () {
                     $('.wrap-create-account').removeClass('proccessing');
                        if (json.error) {
                            $('.wrap-register-message').html(json.message);
                        } else {
                            window.location.reload();
                        }
                    }, 500);
                });
            }
        });
    })(jQuery);
</script>
<?php
get_footer('home-1');
