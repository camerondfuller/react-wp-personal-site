<?php
/**
 * The sidebar containing the main widget area
 *
 * @package lychee
 * @since 1.0.0
 */

global $lychee_opt;

if ($lychee_opt['show-sidebar'] == true) { ?>
	
	<div class="col-md-4">
	
		<?php if ( is_active_sidebar( 'sidebar_blog' ) ) : ?>
			<div id="widget-area" class="sidebar" role="complementary">
				
				<?php dynamic_sidebar( 'sidebar_blog' ); ?>
				
			</div><!-- .widget-area -->
		<?php endif; ?>

	</div>
<?php }
