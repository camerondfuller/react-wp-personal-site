<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php print lychee_shop_intro_sec();?>

<div class="shop">
	<div class="container">

		<?php //Sidebar
		if (is_active_sidebar('sidebar_shop')){?>
		<div class="row">
			<div class="shop-bar">
				<?php dynamic_sidebar( 'sidebar_shop' ); ?>
			</div>
		</div>
		<?php } ?>


		<div class="shop-container">
			<div class="row">
				
				<?php if ( have_posts() ) : ?>

				<ul class="izotope-container home-izotope">
					 <div class="grid-sizer"></div>
					
					<?php while ( have_posts() ) : the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>
				</ul>
				
			<?php
				/**
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
				
				<?php else : ?>
					
					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif;?>
			</div>
		</div>

	</div>
</div>



<?php get_footer( 'shop' ); ?>
