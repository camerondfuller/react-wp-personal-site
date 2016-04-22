<?php
/**
* Blog content
*
* @package lychee
* @since 1.0.0
*
*/

global $lychee_opt;
$custom_thumb = get_post_meta( $post->ID, 'lychee_post_thubmnail' );
$custom_thumb = ( isset( $custom_thumb[0] ) ) ? $custom_thumb[0] : false;

$custom_thumb_iframe = $custom_thumb['video'];

$post_format = ( get_post_format() == true ) ? get_post_format() : 'standard';
	
	if ( $post_format == 'gallery' ) {
		$gallery = lychee_get_post_gallery( $post->ID );
	} elseif ( $post_format == 'quote' ) {
		$quote = lychee_get_first_tag_from_string( $post->post_content, 'blockquote' );
		$post->post_content = str_replace( $quote, '', $post->post_content );
	}

	$empty_image = ( ( $post_format == 'video' && !empty( $iframe ) ) || ( $post_format == 'audio' && !empty( $iframe ) ) || ( $post_format == 'quote' && !empty( $quote ) ) || ( $post_format == 'gallery' && !empty( $gallery ) ) || has_post_thumbnail( $post->ID ) ) ? false : true;


		$post_thumb  = '				<div class="thumbnail-entry">';

			if ( $post_format == 'video' && $custom_thumb_iframe ) {
				

				$post_thumb  .= '<div class="video">';
				$post_thumb  .= $custom_thumb_iframe;
				$post_thumb  .= '</div>';
			

			} elseif ( $post_format == 'audio' && $custom_thumb_iframe ) {

				$post_thumb  .= '<div class="audio">';
				$post_thumb  .= $custom_thumb_iframe;
				$post_thumb  .= '</div>';
			

			} elseif ( $post_format == 'gallery' && !empty( $gallery ) ) {
				$post_thumb .= '					<div class="blog-swiper">';
				$post_thumb .= '						<div class="swiper-container" id="swiper-cont-'.$post->ID.'" data-mode="horizontal" data-touch="1" data-autoplay="2500" data-loop="1" data-speed="900" data-center="0" data-slides-per-view="1">';
				$post_thumb .= '							<div class="swiper-wrapper">';
															foreach ( $gallery as $image ) {
				$post_thumb .= '								<div class="swiper-slide">';
				$post_thumb .= '									<img class="center-image" src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" />';
				$post_thumb .= '								</div>';
															}
				$post_thumb .= '							</div>';
				$post_thumb .= '							<div class="pagination point-style-1"></div>';
				$post_thumb .= '						</div>';
				$post_thumb .= '					</div>';
					} else {
				$post_thumb .= lychee_post_thumbnail( $post->ID, 'thumbnail-img', false );
					}
		$post_thumb .= '				</div>';

		print $post_thumb;


if($lychee_opt['show-post-meta']){ ?>
	<div class="post-line-info single-info">
	<div class="line-item"><span class="fa fa-calendar"></span><?php the_time('M d, Y'); ?></div>
	<div class="line-item"><span class="fa fa-user"></span><?php the_author(); ?></div>
	<div class="line-item"><span class="fa fa-comments"></span><?php comments_number('0'); ?></div>
	<div class="line-item"><span class="fa fa-eye"></span><?php print lychee_post_views(get_the_ID()); ?></div>
	</div>
<?php }