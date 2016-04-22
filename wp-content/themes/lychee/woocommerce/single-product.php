<?php
/**
 * The Template for displaying all single products.
 *
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

//Intro section
$intro_section = get_post_meta( $post->ID, 'lychee_intro_product_section' );
$intro_section = ( isset( $intro_section[0] ) ) ? $intro_section[0] : false;

$introBg = $intro_section['prod_intro_on_post_bg'];
$introTitle = $intro_section['prod_intro_on_post_title'];
$introSubtitle = $intro_section['prod_intro_on_post_subtitle'];

if ($intro_section['prod_enable_intro_on_post']){ ?>
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


	<div class="main-wrapp start-line time-line pad120"> 
		<div class="container">

			<?php //Subtitle section
			$subtitle_section = get_post_meta( $post->ID, 'lychee_subtitle_product_section' );
			$subtitle_section = ( isset( $subtitle_section[0] ) ) ? $subtitle_section[0] : false;

			$middleSubtitle = $subtitle_section['prod_middle_subtitle'];
			$middleTagline = $subtitle_section['prod_middle_tagline'];

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
				<div class="row">


						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>


				</div>
			</div>

		</div>
	</div>

<?php get_footer( 'shop' ); ?>
