<?php
/**
 * Author Page
 *
 * @package lychee
 * @since 1.0.0
 *
 */

global $lychee_opt;

get_header();


if($lychee_opt['show_user_intro'] == true){ ?>

		<div class="top-baner half-height">
			
			<?php 
			$intro_bg_id 	= $lychee_opt['user_intro_background_image'];
			$intro_bg 		= wp_get_attachment_image_src($intro_bg_id, 'full');
			$intro_title 	= $lychee_opt['user_intro_title'];
			$intro_subtitle = $lychee_opt['user_intro_subtitle'];

			if(!empty($intro_bg)) { ?>
			<div class="clip">
				<div class="bg bg-bg-chrome" style="background-image:url(<?php print esc_attr($intro_bg['0']); ?>)"></div>
			</div>
			<?php } ?>

			<div class="main-title">
				<?php if(!empty($intro_title)) print "<h2>".esc_attr($intro_title)."</h2>"; ?>
				<?php if(!empty($intro_subtitle)) print "<h5>".esc_attr($intro_subtitle)."</h5>"; ?>
			</div>
		</div>

<?php }

$mainrow = ($lychee_opt['show-sidebar'] == true) ? 'col-md-8' : 'col-md-12';

if ( have_posts() ) : ?>

<div class="main-wrapp pad120"> 
   <div class="container">
	      <div class="row">
	     	<div class="col-md-12">
	     	  <div class="subtitle">
				<h3><?php printf( __( 'Author: %s', 'lychee' ), get_query_var('author_name') ); ?></h3>
			 </div>
	     	</div>
	      </div>

   	  <div class="padd-80">
	         <div class="row">
	         	
	         	<div class="<?php print esc_attr($mainrow); ?>">
						
	         		<?php get_template_part('content', 'blog'); ?>
					<?php print lychee_post_pagination(); ?>

	         	</div>

	         	<?php get_sidebar('sidebar_blog'); ?>

	         </div>

   	  </div>
   </div>
</div> <!--End main wrap-->

<?php else :

	get_template_part( 'content', 'none' );

endif;

get_footer();