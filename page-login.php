<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header('home-1'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main login" role="main">
            <div class="container">
                <div class="login-wrapper">
                    <div class="login">
                        <form class="login-form" onsubmit="return false;">
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
                                <input type="text" />
                            </div>
                            <div class="password-wrapper">
                                <label>Password</label>
                                <input type="password" />
                            </div>
                            <p class="fg-pass">Forgot Password</p>
                            <button class="btn-login">Login</button>
                        </form>
                    </div>
                    <div class="register">
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
</script>
<?php
get_footer('home-1');
