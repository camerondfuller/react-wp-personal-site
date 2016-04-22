<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();
global $lychee_opt;

//Counter
lychee_set_post_views(get_the_ID());

$mainrow = ($lychee_opt['show-sidebar'] == true) ? 'col-md-8' : 'col-md-12';

//Intro section
$intro_section = get_post_meta( $post->ID, 'lychee_intro_post_section' );
$intro_section = ( isset( $intro_section[0] ) ) ? $intro_section[0] : false;

$introBg = $intro_section['intro_on_post_bg'];
$introTitle = $intro_section['intro_on_post_title'];
$introSubtitle = $intro_section['intro_on_post_subtitle'];

if ($intro_section['enable_intro_on_post']){ ?>
	<div class="top-baner half-height">
		
		<?php if ( !empty($introBg) ){
		$image = wp_get_attachment_image_src( $introBg, 'full' );
		?>
		<div class="clip">
			<div class="bg bg-bg-chrome" style="background-image:url(<?php print esc_attr($image['0']);?>)"></div>
		</div>
		<?php } ?>

		<div class="main-title">
			<?php if ( !empty($introTitle) ) print '<h2>'.$introTitle.'</h2>';
			if ( !empty($introSubtitle) ) print '<h5>'.$introSubtitle.'</h5>';
			?>
		</div>
	</div>
<?php } ?>


<div class="main-wrapp pad120">
	<div class="container">

			<?php //Subtitle section
			$subtitle_section = get_post_meta( $post->ID, 'lychee_subtitle_post_section' );
			$subtitle_section = ( isset( $subtitle_section[0] ) ) ? $subtitle_section[0] : false;

			$middleSubtitle = $subtitle_section['middle_subtitle'];
			$middleTagline = $subtitle_section['middle_tagline'];

			if ( $middleSubtitle || $middleTagline ){?>
				<div class="row">
					<div class="col-md-12">
						<div class="subtitle">
							<?php if ( $middleSubtitle ) print '<h3>'.$middleSubtitle.'</h3>';
							if ( $middleTagline ) print '<p>'.$middleTagline.'</p>'; ?>
						</div>
					</div>
				</div>
			<?php } ?>


			<div class="padd-80">
  	        	<div class="container">

  	        		<div class="row">
  	        			<div class="<?php print esc_attr( $mainrow ); ?>">
						<?php // Start the loop.
						while ( have_posts() ) : the_post();

							get_template_part('content', 'single');

							the_title('<h4>', '</h4>', true); ?>

								<div class="single-content-wrap">
								<?php the_content(); wp_link_pages('before=<div class="post-nav"> <span>Page: </span> &after=</div>');?>
								</div>

							<?php //Show tags/Categories
							if ( (!isset($lychee_opt['show_tags_category'])) || $lychee_opt['show_tags_category'] == true){ ?>
							<div class="pad-80 single-cat-tag">
								<div class="det-tags">
									<h4><?php _e('POST CATEGORIES', 'lychee'); ?></h4>
									<?php if (get_the_category_list()) ?> <div class="tags-button"><?php print get_the_category_list(', '); ?></div>
								</div>
								
								<?php if (get_the_tags()){?>
								<div class="det-tags">
									<h4><?php _e('POST TAGS', 'lychee'); ?></h4>
									<?php the_tags( '<div class="tags-button">', ' ', '</div>' ); ?>
								</div>
								<?php } ?>
							</div>
							<?php } ?>

						<?php // End the loop.
						endwhile; ?>
						</div>

						<?php get_sidebar('sidebar_blog'); ?>

					</div><?php //end single content ?>

					<?php //Show related posts
					if ($lychee_opt['show_related_posts'] == true){ ?>
						<div class="row">
						<?php $relPost = lychee_get_related_posts(get_the_ID(), '2');
							if($relPost){
							foreach ($relPost as $rpost) { 

							$originalDate = $rpost->post_date;
							$newDate = date("M d, Y", strtotime($originalDate)); 
							$postID = $rpost->ID;
							$postThumb = get_the_post_thumbnail($postID, 'medium');
							?>

								<div class="col-md-6">
									 <div class="popular-block padd-80">
										  <?php if ($postThumb){?>
										  <div class="pop-img">
											<?php print $postThumb; ?>
										  </div>
										  <?php } ?>
										  <div class="pop-text">
											 <?php if($rpost->post_title) {?>
											 	<a href="<?php print esc_url( get_permalink($postID) );?>"><h5><?php print esc_html($rpost->post_title);?></h5></a>
											 <?php }?>

											 <?php $postContent = lychee_cut_string($rpost->post_content, '200'); ?>
											 	<p><?php print strip_tags(strip_shortcodes($postContent)); ?></p>
											   <span><?php print $newDate; ?></span>
										  </div>
									  </div>		  
			  	         		</div>

							<?php } 
							}?>
						</div>
					<?php } //End Show related posts ?>

					<?php if ( comments_open() || get_comments_number() ) {
		            	comments_template( '', true );
			        } ?>

				</div>
			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>
