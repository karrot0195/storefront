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
		<main id="main" class="site-main my-account" role="main">
            <div class="container">
                <div class="my-account-wrapper">
                    <div class="title">
                    My Account
                    </div>
                    <div class="content-wrapper">
                        <div class="sidebar">
                            <div class="sidebar__tab current" data-tab="tab-1">
                                Dashboard
                                <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon/wallet.svg"> -->
                            </div>  
                            <div class="sidebar__tab" data-tab="tab-2">
                                Orders
                                <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon/wallet.svg"> -->
                            </div>  
                            <div class="sidebar__tab" data-tab="tab-3">
                                Addresses
                                <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon/house.svg"> -->
                            </div>  
                            <div class="sidebar__tab" data-tab="tab-4">
                                 Account Details
                                 <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon/logout.svg"> -->
                            </div>  
                            <div class="sidebar__tab" data-tab="tab-5">
                                 Log Out
                                 <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon/logout.svg"> -->
                            </div>  
                        </div> 
                        <div class="content">
                            <div id="tab-1" class="tab-content-mc current dashboard">
                                <p>
                                    Hello
                                    <strong> Agnes Mo </strong>
                                    (not<strong> Agnes Mo? </strong><a href="#">Logout</a>)
                                </p>
                                <p>
                                    From your account dashboard you can view your 
                                    <a href="#">recent  order</a>, manage your 
                                    <a href="#">shipping and billing
                                    addresses</a>
                                     and 
                                     <a href="#">edit your password and acount details.</a>
                                </p>
                            </div>
                            <div id="tab-4" class="tab-content-mc account-detail">
                                <form class="edit-account">
                                    <div class="f-l-wrapper">
                                        <p class="form-row form-first">
                                            <label>
                                                First name
                                                <span class="require">*</span>
                                            </label>
                                            <input type="text" class="input-text">
                                        </p>
                                        <p class="form-row form-last">
                                            <label>
                                                Last name
                                                <span class="require">*</span>
                                            </label>
                                            <input type="text" class="input-text">
                                        </p>
                                    </div>
                                    <p class="form-row form-company">
                                        <label>
                                            Company name
                                            <span class="require">*</span>
                                        </label>
                                        <input type="text" class="input-text">
                                    </p>
                                    <div class="p-e-wrapper">
                                        <p class="form-row form-phone">
                                            <label>
                                                Phone
                                                <span class="require">*</span>
                                            </label>
                                            <input type="text" class="input-text">
                                        </p>
                                        <p class="form-row form-email">
                                            <label>
                                                Email Address
                                                <span class="require">*</span>
                                            </label>
                                            <input type="text" class="input-text">
                                        </p>
                                      
                                    </div>
                                    <p class="form-row form-street">
                                        <label>
                                            Street Address
                                            <span class="require">*</span>
                                        </label>
                                        <input type="text" class="input-text" placeholder="House number and street name">
                                        <input type="text" class="input-text" placeholder="Appartment, suite, unit, etc (optional)"> 
                                    </p>
                                    <p class="form-row form-town">
                                        <label>
                                            Town/City
                                            <span class="require">*</span>
                                        </label>
                                        <input type="text" class="input-text">
                                    </p>
                                    <p class="form-row form-country">
                                        <label>
                                            Country
                                            <span class="require">*</span>
                                        </label>
                                        <input type="text" class="input-text">
                                    </p>
                                    <p class="form-row form-post">
                                        <label>
                                            Postcode
                                            <span class="require">*</span>
                                        </label>
                                        <input type="text" class="input-text">
                                    </p>
                                <form>
                            </div>
                        </div>   
                    </div>      
                </div>        
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
