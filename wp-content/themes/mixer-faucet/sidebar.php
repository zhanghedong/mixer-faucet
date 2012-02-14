<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = basket_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
		<div class="aboutus-desc">
                     <div class="aboutus-desc-wrap">
		      <div class="aboutus-desc-content">
			     <address class="address">Fuzhou Bes Home Decor Co., Ltd. [ Fujian, China (Mainland) ] </address>
                             
                              
                      </div>
</div>
                </div>


			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'basket' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'basket' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
			<div class="msn-ct">
<h3>Contact Person</h3>
		<ul>
		  <li><a target="_blank" href="http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=3bff470cb3a2999b@apps.messenger.live.com&mkt="><img style="border-style: none;" src="http://messenger.services.live.com/users/3bff470cb3a2999b@apps.messenger.live.com/presenceimage?mkt=" width="16" height="16" />fzbes@hotmail.com</a>
		</li>
		<li>
		<a target="_blank" href="http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=7ea19262834119e@apps.messenger.live.com&mkt="><img style="border-style: none;" src="http://messenger.services.live.com/users/7ea19262834119e@apps.messenger.live.com/presenceimage?mkt=" width="16" height="16" />fzbes1@hotmail.com</a>
		</li>
		<li>
		<a target="_blank" href="http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=21976751135255bf@apps.messenger.live.com&mkt="><img style="border-style: none;" src="http://messenger.services.live.com/users/21976751135255bf@apps.messenger.live.com/presenceimage?mkt=" width="16" height="16" />fzbes2@hotmail.com</a>
		</li>
		<li>
		<a target="_blank" href="http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=6aed0211c1bbf5b2@apps.messenger.live.com&mkt="><img style="border-style: none;" src="http://messenger.services.live.com/users/6aed0211c1bbf5b2@apps.messenger.live.com/presenceimage?mkt=" width="16" height="16" />fzbes3@hotmail.com</a>
		</li>
		</ul>

                       </div>
<div class="links">
 <ul>
   <li><a href="http://www.fzbes.com.cn">www.fzbes.com.cn</a></li>
   <li><a href="http://www.clock-clock.com">www.clock-clock.com</a></li>
   <li><a href="www.bes-homedecor.com">www.bes-homedecor.com</a></li>

 </ul>
</div>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>
