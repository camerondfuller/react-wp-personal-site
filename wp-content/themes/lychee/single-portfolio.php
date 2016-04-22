<?php
/**
* Single Portfolio Template
*
* @package lychee
* @since 1.0.0
*
*/

global $lychee_opt;

$portfolio_details = get_post_meta( $post->ID, 'lychee_custom_portfolio_main_options' );
$portfolio_details = ( isset( $portfolio_details[0] ) ) ? $portfolio_details[0] : false;

$is_thumb = has_post_thumbnail( $post->ID );
if ( $is_thumb ) {
    $image_id = get_post_thumbnail_id( $post->ID );
    $image = wp_get_attachment_image_src( $image_id, 'full' );
    $back_src = $image[0];
} else {
    $back_src = false;
}

$categories = wp_get_post_terms( $post->ID, 'portfolio-category' );
$tags = wp_get_post_terms( $post->ID, 'portfolio-tag' );

$post_meta = get_post_meta( $post->ID, 'lychee_custom_portfolio_side_options' );
$post_meta = ( isset( $post_meta[0] ) ) ? $post_meta[0] : false;

get_header(); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="top-baner<?php print ( $back_src ? ' half-height' : ' height-300' ); ?>">
            <?php if ( $back_src ) { ?>
			<div class="clip">
				<div class="bg bg-bg-chrome" style="background-image:url(<?php echo esc_url( $back_src ); ?>)">
				</div>
			</div>
            <?php } ?>
			<div class="main-title">
				<h2><?php the_title(); ?></h2>
			</div>
		</div>
		<div class="main-wrapp">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-push-8">
						<div class="fixed-detail-panel">
							<div class="fixed-detail-txt bg-grey-light">
								<h3><?php the_title(); ?></h3>
								<?php the_content(); ?>
							</div>
                            <?php if ( $portfolio_details['meta_fields'] || ( $post_meta['show-categories'] && $categories ) || ( $post_meta['show-tags'] && $tags ) ) { ?>
							<div class="fixed-detail-txt bg-grey-light ">
                            <?php if ( $portfolio_details['meta_fields'] ) { ?>
                            <?php foreach ( $portfolio_details['meta_fields'] as $detail ) { ?>
                                <span><?php echo esc_attr( $detail['title'] ); ?></span>
                                <h5><?php print esc_attr( $detail['value'] ); ?></h5>
                            <?php }
                            } ?>
                            <?php if ( $post_meta['show-categories'] && $categories ) { ?>
                                <span><?php _e( 'Categories', 'lychee' ); ?>:</span>
                                <h5><?php
                                $i = 0;
                                foreach ( $categories as $category ) {
                                    if ( ++$i > 1 ) echo ', ';
                                    echo '<a href="' . esc_url( get_term_link( $category ) ) . '">' . $category->name . '</a>';
                                }
                                unset( $i ); ?></h5>
                            <?php } ?>
							</div>
                            <?php } ?>
						</div>
					</div>
					<div class="col-md-8 col-md-pull-4">
                        <?php if ( $portfolio_details['video'] ) { ?>
                        <div class="full-width padd-40 det-wrapp">
                            <div class="video-wrap">
                                <div class="video">
                                    <?php print $portfolio_details['video']; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ( $portfolio_details['gallery_slider'] ) {
                            $gallery_slides = explode( ',', $portfolio_details['gallery_slider'] );?>
                            <div class="full-width padd-40 det-wrapp">
                                <div class="slider-wrap">
                                    <div class="swiper-container slider-1" data-autoplay="3000" data-touch="1" data-mouse="0" data-slides-per-view="1" data-loop="0" data-speed="1800" data-mode="horizontal" id="slider-1">
                                        <div class="swiper-wrapper">
                                            <?php foreach ( $gallery_slides as $image ) {
                                                if ( $image && is_numeric( $image ) ) {
                                                    $src = wp_get_attachment_url( $image );
                                                }
                                                if ( !$src ) continue; ?>
                                                <div class="swiper-slide">
                                                    <?php print wp_get_attachment_image( $image, 'full' ); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="pagination"></div>
                                    </div>
                                    <div class="slide-prev arrow-style-1"><span class="fa fa-angle-left"></span></div>
                                    <div class="slide-next arrow-style-1"><span class="fa fa-angle-right"></span></div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ( $portfolio_details['gallery_simple'] ) {
                            $gallery_simple = explode( ',', $portfolio_details['gallery_simple'] );
                            foreach ( $gallery_simple as $image ) {
                                if ( $image && is_numeric( $image ) ) {
                                    $src = wp_get_attachment_url( $image );
                                }
                                if ( !$src ) continue; ?>
                                <div class="full-width padd-40 det-wrapp">
                                    <?php print wp_get_attachment_image( $image, 'full' ); ?>
                                </div>
                            <?php }
                        } ?>
						<div class="project-nav">
							<div class="row">
								<div class="col-md-12">
									<div class="left-arrow-nav">
                                        <?php previous_post_link( '%link', '<span>' . __( 'Previous Project', 'lychee' ) . '</span>' ); ?>
									</div>
									<div class="right-arrow-nav">
                                        <?php next_post_link( '%link', '<span>' . __( 'Next Project', 'lychee' ) . '</span>' ); ?>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	<?php endwhile;
endif;
?>

<?php get_footer(); ?>