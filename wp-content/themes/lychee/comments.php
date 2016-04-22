<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="row">
	<div id="comments" class="comments-area">

		<div class="col-md-6">
			<div class="comments">
				<?php
				$count = wp_count_comments( get_the_ID() );
				$approved_comment = $count->approved;
				?>

				<h3><?php printf( _nx( '1 comment', '%1$s comments', $approved_comment, 'comments title', 'lychee' ), number_format_i18n( $approved_comment ) ); ?></h3>
			

		<?php lychee_comment_nav(); ?>

		<div class="comments" id="comments">
			<?php
				wp_list_comments( array(
				  'style'             => 'div',
				  'short_ping'        => true,
				  'avatar_size'       => 80,
				  'callback'          => 'lychee_comment',
				  'type'              => 'all',
				  'format'            => 'htm5',
				  'reply_text'        => 'reply',
				  'page'              => '',
				  'per_page'          => '',
				  'reverse_top_level' => null,
				  'reverse_children'  => ''
				) );
			?>
		</div>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( !comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'lychee' ); ?></p>
	<?php endif; ?>


			</div>
		
		</div>

		<div class="col-md-6">
			<?php lychee_comment_form(); ?>
		</div>
	

	</div><!-- .comments-area -->
</div>
