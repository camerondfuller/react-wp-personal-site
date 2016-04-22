<?php
/**
 * Arhive Page
 *
 * @package lychee
 * @since 1.0.0
 *
 */

global $lychee_opt;
global $wp_query;
global $post;

get_header();
$tag = $wp_query->get_queried_object();

if($lychee_opt['show_arhive_intro'] == true){

	$category_id = $tag->term_id;

	lychee_intro_sec($category_id);
}

	$catTitle = single_cat_title( '', false );
	$catDescription = term_description( $category_id, 'portfolio-category' );


$row_width 			= ($lychee_opt['portfolio_full_width'] == true) ? 'container-fluid' : 'container';
$hover_class 		= ($lychee_opt['portfolio_hover_style'] == 'dark') ? ' bl_layer' : '';
$columns 			= $lychee_opt['portfolio_col'];
$portfolio_style 	= $lychee_opt['portfolio_style'];

	switch ( $portfolio_style ) {
		case 'boxed':
			$izotope_class = ' nogutt-col' . $columns;
			break;
		case 'boxed_gutter':
			$izotope_class = ' gutt-col' . $columns;
			break;
		default:
			$izotope_class = ' home-izotope';
			break;
	}



if ( have_posts() ) : ?>

<div class="main-wrapp pad120"> 
   <div class="<?php print esc_attr( $row_width ); ?>">
	     	<div class="col-md-12">
	     	  <div class="subtitle">
				<?php if(!empty( $catTitle )) print "<h3>". $catTitle ."</h3>"; ?>
				<?php if(!empty( $catDescription )) print $catDescription; ?>
			 </div>
	     	</div>

   	  <div class="padd-80">

			<div class="main-wrapp">
			
				<div class="izotope-container <?php print esc_attr($izotope_class); ?>">
				<div class="grid-sizer"></div>

					<?php while ( have_posts() ) : the_post(); 
						$post_meta = get_post_meta( get_the_ID(), 'lychee_custom_portfolio_side_options' );
						$wide_class = ( $post_meta[0]['wide-in-portfolio'] ) ? ' w-50' : '';
					?>

					<div class="item <?php print esc_attr($wide_class); ?>">
						<div class="layer <?php print esc_attr($hover_class); ?>">
							<a href="<?php the_permalink();?>" class="animsition-link"></a>
							<div class="vertical-align">
								<h4><?php the_title(); ?></h4>
								<h5><?php //print implode( ', ', $portfolio_details ); ?></h5>
							</div>
						</div>
						<?php the_post_thumbnail(); ?>
					</div>
					
					<?php endwhile; ?>

				</div>

				<?php print lychee_post_pagination(); ?>
			
			</div>

   	  </div>
   </div>
</div> <!--End main wrap-->

<?php else :

	get_template_part( 'content', 'none' );

endif;

get_footer();