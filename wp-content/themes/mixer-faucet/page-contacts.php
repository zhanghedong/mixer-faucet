<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header();


?>

		<div id="primary" class="primary">
			<div id="content" role="main" class="content">
				<?php get_template_part( 'content', 'contacts' ); ?>
				<div id="send-message" class="send-form-wrap">
				<?php comments_template( '', true ); ?>
                
<div class="c-info">
<p>FUZHOU BES HOME DECOR CO., LTD </p>
<p>Add.: 5/F, 1# BUILDING, NO.7 JINZHOU NORTH ROAD, JINSHAN, FUZHOU, CHINA </p>
<p>Tel: +0086-591-28053590/79</p>
<p>Fax: +0086-591-28053580</p>
<p>E-mail: sales@fzbes.com</p>
<p><a href="http://www.fzbes.com" target="_blank">http://www.fzbes.com</a></p>
<p><a href="http://www.fzbes.com.cn" target="_blank">http://www.fzbes.com.cn</a></p>
<p><a href="http://www.clock-clock.com" target="_blank">http://www.clock-clock.com</a></p>
</div>
                              </div>
			</div><!-- #content -->
		</div><!-- #primary -->
	<?php //comments_template( '', true ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
