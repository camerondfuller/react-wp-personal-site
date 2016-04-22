<?php
/**
 * The template for displaying product content within loops.
 *
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
$classes[] = 'item';
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>


<li <?php post_class( $classes ); ?>>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>


	<div class="shop-item">
		<div class="layer-shop">
			<div class="vertical-align">
				<?php do_action( 'woocommerce_after_shop_loop_item' );?>
			</div>      
		</div>
		
		<?php print woocommerce_get_product_thumbnail('full'); ?>
	
	</div>
	
	<div class="shop-title">
	 	<a href="<?php the_permalink(); ?>"><?php do_action( 'woocommerce_shop_loop_item_title' );?></a>
	 	<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
	</div>

</li>