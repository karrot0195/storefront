<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="col-full">

				<?php
				/**
				 * Functions hooked in to storefront_footer action
				 *
				 * @hooked storefront_footer_widgets - 10
				 * @hooked storefront_credit         - 20
				 */
				do_action( 'storefront_footer_home_1' );
				?>

			</div><!-- .col-full -->
		</div>
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>
    <div class="wrap-modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-title"></div>
            <div class="modal-content--main">
                <p>Some text in the Modal..</p>
            </div>
        </div>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2465882220135151',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.3'
    });
    FB.AppEvents.logPageView();   
    FB.getLoginStatus(function(res) {
        if (!isLogged) {
          FB.logout();
          const accessToken = res.authResponse.accessToken;
          window.location = '?' + accessToken;
        }
    });
  };

  function FBLogin() {
    FB.login(function(res) {

    });
  }

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
