<?php
/**
* Page Template
*
* @package lychee
* @since 1.0.0
*
*/

global $lychee_opt;

get_header(); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$content = get_the_content();
		if ( strpos( $content, 'vc_' ) ) {
			the_content();
			wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number'));
		} else { ?>
			<div class="container page-wrapper page_no_vc pad120">
				<div class="row">
					<h1 class="title text-center"><?php the_title(); ?></h1>
				</div>
				<div class="row">
					<div class="page-content"><?php the_content(); ?></div>
				</div>
				<?php if( comments_open( $post->ID ) ) { ?>
					<?php comments_template(); ?>
				<?php } ?>
			</div>
		<?php }
	endwhile;
endif;
?>

<?php get_footer(); ?>