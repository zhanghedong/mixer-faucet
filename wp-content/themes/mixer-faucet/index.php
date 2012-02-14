<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
global $images_meta_key,$description_value,$showcase_cat_id;
get_header(); ?>
		<div id="primary" class="primary">
			<div id="content" role="main" class="content">
<div class="aboutus">
 <div class="banner">
  <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>/images/banner/aboutus_1.jpg" alt="bes" id="img_player" /></div>
<script type="text/javascript">
Basket.imgSrc =  ["<?php echo get_template_directory_uri(); ?>/images/banner/aboutus_1.jpg", "<?php echo get_template_directory_uri(); ?>/images/banner/aboutus_2.jpg", "<?php echo get_template_directory_uri(); ?>/images/banner/aboutus_3.jpg"];


</script>
   <p class="switch" id="div_switch"><a href="#" class="active" data-index="0">1</a><a href="#" data-index="1">2</a><a href="#" data-index="2">3</a></p>
 </div>
<div class="desc">
<?php
$aboutus_id = get_id_by_slug('aboutus');
echo get_post_meta($aboutus_id, 'about_me_excerpt', true);
?>
<p><a href="#"><a href="<?php echo get_page_link_by_slug('aboutus'); ?>">Read more</a></a></p>


<div class="contact"> 
<a title="Click to send a message" class="button-contact-now" target="_blank" href="<?php echo get_page_link_by_slug('contacts'); ?>" rel="nofollow"></a>
</div>
</div>
<div class="clear"></div>
</div>
			<?php 

$showcase_cat_name = get_cat_name($showcase_cat_id);
$query = new WP_Query( array ( 'meta_key' => $imagesMetaKey, 'cat' => $showcase_cat_id , 'showposts' => 20 ) );
//var_dump ($query);//查看sql
if ( $query->have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<div class="product-ct">
				<h2 class="title-nav"><a class="more" href="<?php echo get_category_link( $showcase_cat_id ); ?>">See more</a><?php echo $showcase_cat_name;?></h2>
                                  <ul class="product-list">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php get_template_part( 'content-product', get_post_format() ); ?>
				<?php endwhile; ?>
                                  </ul>
<div class="clear"></div>
                                </div>
			<?php endif; ?>

<?php
$query = new WP_Query( array ( 'showposts' => 8, 'orderby' => 'post_modified', 'order' => 'desc'  ) );
//var_dump ($query);
if ( $query->have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<div class="product-ct">
				<h2 class="title-nav">New Products</h2>
                                  <ul class="product-list">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php get_template_part( 'content-product', get_post_format() ); ?>
				<?php endwhile; ?>
                                  </ul>
<div class="clear"></div>
                                </div>
			<?php endif; ?>




			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
