<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<section id="primary" class="primary">
			<div id="content" role="main" class="content">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
				<h1 class="page-title title-nav">
				<?php //var_dump($wp_query);?>   
<p class="contact-wrap">				 
<a  href="<?php echo get_page_link_by_slug('contacts');?>" target="_blank" class="button-contact-now" title="Click to send a message"></a>
<span>Select</span>
<input  disabled="disabled" type="checkbox" />
<span>to</span>
</p>
                                      <?php
						printf( __( '%s', 'basket' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>
				</header>
				<?php /* Start the Loop */ ?>
				<div class="product-ct">
                                  <ul class="product-list">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						get_template_part( 'content-product', get_post_format() );
					?>

				<?php endwhile; ?>
				  </ul>
                                </div>

				<?php// basket_content_nav( 'nav-below' ); ?>

<?php if(function_exists('wp_paginate')) {
    wp_paginate();
} ?>
						

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'basket' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'basket' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
