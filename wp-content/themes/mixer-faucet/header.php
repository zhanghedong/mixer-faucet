<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
global $page, $paged, $images_meta_key,$description_value,$showcase_cat_id;
	wp_title( '|', true, 'right' );
bloginfo( 'name' );?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php

	$images_meta_key = 'attached_file_value';
	$description_value = 'description_value';
	$showcase_cat_id = 1;


	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
	<script type="text/javascript">
		var Basket = {};	
		Basket.baseUrl = '<?php echo  get_bloginfo('url') ?>';
		Basket.tempUrl = '<?php echo get_template_directory_uri(); ?>';
		Basket.contactsUrl = '<?php echo get_page_link_by_slug('contacts');?>';
	</script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<header id="branding" class="branding" role="banner">
			<hgroup class="site-logo">
				<h2 id="site-name" class="site-name"><?php// bloginfo( 'name' ); ?></h2>
			</hgroup>
        <div class="head-tip">
            www.mixer-faucet.com&nbsp;&nbsp;&nbsp;&nbsp;Tel: 0086-591-28053579&nbsp;&nbsp;&nbsp;&nbsp;Email: sales@mixer-faucet.com
        </div>
			<?php
				// Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) :
			?>
				<div class="only-search<?php if ( ! empty( $header_image ) ) : ?> with-image<?php endif; ?>">
				<?php get_search_form(); ?>
				</div>
		
				
			<?php endif; ?>

			<nav id="access" role="navigation">
				<?php get_search_form(); ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	<div class="clear"></div>
			</nav><!-- #access -->
<div class="banner0">
  <img src="<?php echo get_template_directory_uri(); ?>/images/banner/banner.jpg" alt=""  />
</div>
	</header><!-- #branding -->


	<div id="main" class="main">
