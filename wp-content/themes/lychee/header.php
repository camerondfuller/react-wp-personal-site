<?php
/**
 * Header
 *
 * @package lychee
 * @since 1.0.0
 *
 */

global $lychee_opt;

$body_class = 'animsition';

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class( $body_class ); ?>>

	<!-- HEADER -->
	<header>
		
		<?php $type_logo = cs_get_option('type_logo');?>
		<div class="logo">
			<a href="<?php echo esc_url( home_url('/') ); ?>">
				<?php if ($type_logo == 'type_graphic_logo') {
					$logo_img_id = cs_get_option('img_logo');
					if ( !empty( $logo_img_id ) ) {
						$src = ( !empty( $logo_img_id ) && is_numeric( $logo_img_id ) ) ? wp_get_attachment_url( $logo_img_id ) : false;
						$alt = get_post_meta($logo_img_id, '_wp_attachment_image_alt', true); ?>
						<img src="<?php print esc_attr($src);?>" alt="<?php print esc_html($alt); ?>">
					<?php } ?>

				<?php }else{
					if ( cs_get_option() !== false ) {
						print esc_html(cs_get_option('text_logo'));
					} else {
						print  __( 'Lychee', 'lychee' );
					}
				} ?>
			</a>
		</div>

		<?php //Shoping cart
		if ( class_exists( 'WooCommerce' ) ) { ?>
			<div class="header-cart">
				<i class="cs-icon fa fa-shopping-cart"></i>
				<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'lychee' ); ?>">
					<?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'lychee' ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?>
				</a>
			</div>
		<?php } ?>

		<?php lychee_primary_nav(); ?>

	</header>