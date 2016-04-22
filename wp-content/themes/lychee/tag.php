<?php
/**
 * Tags Arhive Page
 *
 * @package lychee
 * @since 1.0.0
 *
 */

global $lychee_opt;

get_header();



if(cs_get_option() === false || $lychee_opt['show_arhive_intro'] == true ){

	$category_id = get_query_var('tag_id');

	lychee_intro_sec($category_id);
}

	$catTitle = single_tag_title( '', false );
	$catDescription = tag_description( $category_id );

$mainrow = ($lychee_opt['show-sidebar'] == true) ? 'col-md-8' : 'col-md-12';

if ( have_posts() ) : ?>

<div class="main-wrapp pad120"> 
   <div class="container">
	      <div class="row">
	     	<div class="col-md-12">
	     	  <div class="subtitle">
				<?php if(!empty( $catTitle )) print "<h3>". $catTitle ."</h3>"; ?>
				<?php if(!empty( $catDescription )) print $catDescription; ?>
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