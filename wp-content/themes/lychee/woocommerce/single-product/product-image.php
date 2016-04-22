<?php
/**
 * Single Product Image
 *
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>

<div class="swiper-container slider-7" data-autoplay="3000" data-touch="1" data-mouse="0" data-slides-per-view="1" data-loop="0" data-speed="1800" data-mode="horizontal" id="slider-7">  
	<div class="swiper-wrapper">

		<?php
		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			
			print '<div class="swiper-slide"><img src="'.$image_link.'" alt="'.$image_title.'"></div>';

		} 

		$attachment_count = count( $product->get_gallery_attachment_ids() );


		if ( $attachment_count > 0 ) {
			$attachmentID = $product->get_gallery_attachment_ids();
			foreach ($attachmentID as $att_ID) { ?>
			<div class="swiper-slide">
				<?php print wp_get_attachment_image( $att_ID, 'full');?>
			</div>
			<?php }
		}
		?>

	</div>
	<div class="pagination"></div>
</div>