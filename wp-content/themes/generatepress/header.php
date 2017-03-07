<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package GeneratePress
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script src="https://use.fontawesome.com/cbef9469c6.js"></script>
	<script src="http://momentjs.com/downloads/moment.min.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php generate_body_schema();?> <?php body_class(); ?>>
	<?php do_action( 'generate_before_header' ); ?>
	<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'generatepress' ); ?>"><?php _e( 'Skip to content', 'generatepress' ); ?></a>
	<header itemtype="http://schema.org/WPHeader" itemscope="itemscope" id="masthead" <?php generate_header_class(); ?>>
			<div class="serchheder">
			<div class="footer-top">
         <p>
          	<a  class="social-link" href=""><i class="fa fa-2x fa-vk" aria-hidden="true"></i></a>
          	<a  class="social-link" href=""><i class="fa fa-2x fa-youtube" aria-hidden="true"></i></a>
          	<a  class="social-link" href=""><i class="fa fa-2x fa-facebook" aria-hidden="true"></i></a>
          	<a  class="social-link" href=""><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></a>               
          </p>
                </div>
                <div class="top-search">
                	<form method="get" class="search-form" action="http://library.com/">
					<label>
						<span class="screen-reader-text">Поиск:</span>
						<input type="search" class="search-field" placeholder="Пошук …" value="" name="s" title="Поиск:">

					</label>
					<button type="submit" class="search-submit" value="П">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
					</form>
                </div>
				
			</div>
		<div <?php generate_inside_header_class(); ?>>
			<?php do_action( 'generate_before_header_content' ); ?>
			<?php generate_header_items(); ?>
			<div class="site-logo">
			<a href="http://www.hneu.edu.ua/" title="Науково-технічна бібліотека   Харківского  національного економічного університету імені Семена Кузнеця" rel="home">
				<img class="header-image" src="http://www.ei.hneu.edu.ua/images/logo2.png" style="width: 140px;" >
			</a>
		</div>
			<?php do_action( 'generate_after_header_content' ); ?>
		</div><!-- .inside-header -->
	</header><!-- #masthead -->
	<?php do_action( 'generate_after_header' ); ?>
	
	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">
			<?php do_action( 'generate_inside_container' ); ?>