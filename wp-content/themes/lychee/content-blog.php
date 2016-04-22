<?php
/**
* Blog content
*
* @package lychee
* @since 1.0.0
*
*/

global $lychee_opt;

$blogStyle = (isset($lychee_opt['blog_style'])) ? $lychee_opt['blog_style'] : '';

if($blogStyle == '3col_masonry') { ?>
<div class="izotope-container gutt-col3">
	<div class="grid-sizer"></div>
	<?php } elseif($blogStyle == '3col_bootstrap') { ?>
	<div class="row">
		<?php }

		$int  = 0;
		$count_posts = get_option('posts_per_page');

		while ( have_posts() ) : the_post();

		$custom_thumb = get_post_meta( $post->ID, 'lychee_post_thubmnail' );
		$custom_thumb = ( isset( $custom_thumb[0] ) ) ? $custom_thumb[0] : false;

		$custom_thumb_iframe = $custom_thumb['video'];

		$post_format = ( get_post_format() == true ) ? get_post_format() : 'standard';

		$content = get_the_content();
		$get_media = lychee_post_media($content);

		if ( $post_format == 'gallery' ) {
			$gallery = lychee_get_post_gallery( $post->ID );
		} elseif ( $post_format == 'video' OR $post_format == 'audio' ) {

			$iframe = lychee_get_first_tag_from_string( $post->post_content );
			$post->post_content = str_replace( $iframe, '', $post->post_content );

			$get_media = $custom_thumb_iframe;


		} elseif ( $post_format == 'quote' ) {
			$quote = lychee_get_first_tag_from_string( $post->post_content, 'blockquote' );
			$post->post_content = str_replace( $quote, '', $post->post_content );
		}

		$empty_image = ( ( $post_format == 'video' && !empty( $iframe ) ) || ( $post_format == 'audio' && !empty( $iframe ) ) || ( $post_format == 'quote' && !empty( $quote ) ) || ( $post_format == 'gallery' && !empty( $gallery ) ) || has_post_thumbnail( $post->ID ) ) ? false : true;

		$post_thumb  = '				<div class="thumbnail-entry">';

		if ( $post_format == 'video' && ($get_media || $custom_thumb['video'])) {

			$post_thumb  .= '<div class="video">';
			$post_thumb  .= ($custom_thumb) ? $custom_thumb_iframe : $get_media;
			$post_thumb  .= '</div>';


		} elseif ( $post_format == 'audio' && ($get_media || $custom_thumb['video'])) {

			$post_thumb  .= '<div class="audio">';
			$post_thumb  .= ($custom_thumb) ? $custom_thumb_iframe : $get_media;
			$post_thumb  .= '</div>';
			

		} elseif ( $post_format == 'quote' && !empty( $quote ) ) {
			$post_thumb .= $quote;
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
			$post_thumb .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" title="' . esc_textarea( $post->post_title ) . '">';
			$post_thumb .= lychee_post_thumbnail( $post->ID, 'thumbnail-img', false );
			$post_thumb .= '</a>';
		}
		$post_thumb .= '				</div>';


		if($blogStyle == '3col_bootstrap') { 
		//Bootstrap 3 coll ?>

		<div id="post-id-<?php the_ID(); ?>" <?php post_class( 'col-md-4 col-sm-12 bootstrap-3-coll ' );?> >
			<div class="blog-item">

				<?php print $post_thumb; ?>

				<?php if($lychee_opt['show-post-meta']){ ?>
				<div class="top-bar">
					<a href="<?php print esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"> <?php print esc_html__('by ', 'lychee').get_the_author(); ?></a>
					<span><?php the_time('d/m/Y'); ?></span>
					<a href="<?php the_permalink(); ?>#respond" title="<?php the_title(); ?>"><?php print comments_number('0'); esc_html_e(' comm', 'lychee');?></a>
				</div>
				<?php } ?>

				<?php if (get_the_title()){ ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h4><?php the_title(); ?></h4></a>
				<?php } ?>
				
				<?php the_excerpt();?>

				<div class="button-style-2"><a href="<?php the_permalink(); ?>" class="b-md butt-style" title="<?php esc_html_e( 'read more', 'lychee' ); ?>"><?php esc_html_e( 'read more', 'lychee' ); ?></a></div>

			</div>
		</div>

		<?php $int++;
		if ($int != 0 && $int%3 === 0 && $int != $count_posts) { ?>
			</div>
			<div class="row">
		<?php } ?>


		<?php } elseif($blogStyle == '3col_masonry') { 
		//Bootstrap 3 coll masonry ?>

		<div id="post-id-<?php the_ID(); ?>" <?php post_class( 'blog-item item ' );?> >

			<?php print $post_thumb; ?>

			<?php if($lychee_opt['show-post-meta']){ ?>
			<div class="top-bar">
				<a href="<?php print esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"> <?php print esc_html__('by ', 'lychee').get_the_author(); ?></a>
				<span><?php the_time('d/m/Y'); ?></span>
				<a href="<?php the_permalink(); ?>#respond" title="<?php the_title(); ?>"><?php print comments_number('0'); esc_html_e(' comm', 'lychee');?></a>
			</div>
			<?php } ?>

			<?php if (get_the_title()){ ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h4><?php the_title(); ?></h4></a>
			<?php } ?>

			<p><?php the_excerpt(); ?></p>
			<div class="button-style-2"><a href="<?php the_permalink(); ?>" class="b-md butt-style" title="<?php esc_html_e( 'read more', 'lychee' ); ?>"><?php esc_html_e( 'read more', 'lychee' ); ?></a></div>

		</div>


		<?php } else {
		//Fullwidth blog ?>

		<div id="post-id-<?php the_ID(); ?>" <?php post_class( 'blog-post ' );?> >

			<?php print $post_thumb; ?>

			<?php if($lychee_opt['show-post-meta']){ ?>
			<div class="post-line-info">
				<div class="line-item"><span class="fa fa-calendar"></span><?php the_time('M d, Y'); ?></div>
				<div class="line-item"><span class="fa fa-user"></span><?php the_author(); ?></div>
				<div class="line-item"><span class="fa fa-comments"></span><?php comments_number('0'); ?></div>
				<div class="line-item"><span class="fa fa-eye"></span><?php print lychee_post_views(get_the_ID()); ?></div>
			</div>
			<?php } ?>

			<?php if (get_the_title()){ ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h4><?php the_title(); ?></h4></a>
			<?php } ?>

			<p><?php the_excerpt(); ?></p>

			<div class="button-style-6"><a href="<?php the_permalink(); ?>" class="b-md butt-style" title="<?php esc_html_e( 'read more', 'lychee' ); ?>"><?php esc_html_e( 'read more', 'lychee' ); ?></a></div>

		</div>

		<?php }


		endwhile;

		if($blogStyle == '3col_masonry') { ?>
	
		</div>
	
	<?php } elseif($blogStyle == '3col_bootstrap') { ?>
</div>
<?php }