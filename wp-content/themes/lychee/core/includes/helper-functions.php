<?php
/**
 * Including theme helper functions
 *
 * @package lychee
 * @since 1.0.0
 *
 */



/**
 * Check string if it exploadable
 *
 * @param  [string]  $page_name string which need to be checked
 *
 * @return [boolean] true if exploadable, false - if not exploadable
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'is_explodable' ) ) {
	function is_explodable( $page_name ) {
		return ( strpos( $page_name, ',' ) === false ) ? false : true;
	}
}



/**
 * Check is js_composer activated
 *
 * @return [bool] true in success, false in failure
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'is_vc_activated' ) ) {
	function is_vc_activated() {
		if ( class_exists( 'Vc_Manager' ) && defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '4.2.3', '>=' ) ) {
			return true;
		} else {
			return false;
		}
	}
}



/**
 * Check if shortcode is exists in this context
 *
 * @param  [string]		$shortcode		shortcode name
 *
 * @return [boolean]	true if exists, false if not exists
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_shortcode_exists' ) ) {
	function lychee_shortcode_exists( $shortcode = false ) {
		global $shortcode_tags;

		if ( !$shortcode ) {
			return false;
		}
		if ( array_key_exists( $shortcode, $shortcode_tags ) ) {
			return true;
		}
		return false;
	}
}



/**
 * Get first "url" from post content or string
 *
 * @return [stirng] url if success, [bool] false in failure
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_get_first_url_from_string' ) ) {
	function lychee_get_first_url_from_string( $string ) {
		$pattern  = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );
		return ( !empty( $link[0] ) ) ? $link[0] : false;
	}
}



/**
 * Get tag from post content or string
 *
 * @return [stirng] needed tag if success, [bool] false in failure
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_get_first_tag_from_string' ) ) {
	function lychee_get_first_tag_from_string( $string, $tag = 'iframe' ) {
		switch ( $tag ) {
			case 'iframe':
				$pattern  = '/<' . $tag . '.*src=\"(.*)\".*><\/' . $tag . '>/isU';
				break;
			default:
				$pattern  = '/<' . $tag . '.*><\/' . $tag . '>/isU';
				break;
		}
		preg_match( $pattern, $string, $link );
		return ( !empty( $link[0] ) ) ? $link[0] : false;
	}
}



/**
 * Custom Regular Expression
 *
 * @return regexp
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_get_shortcode_regex' ) ) {
	function lychee_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
		'\\['                                // Opening bracket
		. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		. "($tagregexp)"                     // 2: Shortcode name
		. '(?![\\w-])'                       // Not followed by word character or hyphen
		. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
		.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		.     '(?:'
		.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		.     ')*?'
		. ')'
		. '(?:'
		.     '(\\/)'                        // 4: Self closing tag ...
		.     '\\]'                          // ... and closing bracket
		. '|'
		.     '\\]'                          // Closing bracket
		.     '(?:'
		.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		.             '[^\\[]*+'             // Not an opening bracket
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		.                 '[^\\[]*+'         // Not an opening bracket
		.             ')*+'
		.         ')'
		.         '\\[\\/\\2\\]'             // Closing shortcode tag
		.     ')?'
		. ')'
		. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}



/**
 * Tag Regular Expression
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_tagregexp' ) ) {
	function lychee_tagregexp() {
		return apply_filters( 'lychee_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|cs_media' );
	}
}



/**
 * Get related posts
 *
 * @param  [integer] $post_id   ID of post
 * @param  [integer] $posts_qty Number of related posts, that we need to get
 *
 * @return [array] Array with related posts in success, [bool] false in failure
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_get_related_posts' ) ) {
	function lychee_get_related_posts( $post_id = NULL, $posts_qty = 5 ) {
		global $post;
		$post_id = ( $post_id != NULL )? $post_id : $post->ID;
		$related_posts_args = array(
			'category__in' => wp_get_post_categories($post_id),
			'numberposts' => $posts_qty,
			'post__not_in' => array( $post_id ),
			'orderby' => 'rand',
		);

		$related = get_posts( $related_posts_args );
		return ( $related ) ? $related : false;
	}
}



/**
 * Get post gallery if it exists
 *
 * @param  [string/int]		$post_id		post ID with gallery
 *
 * @return [array/bool]		Array images url and alt in success, [bool] false in failure
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_get_post_gallery' ) ) {
	function lychee_get_post_gallery( $post_id = null ) {
		if ( $post_id == null && isset( $post ) && is_object( $post ) ) { $post_id = $post->ID; }

		$gallery = get_post_gallery( $post_id, false );
		if ( isset( $gallery['ids'] ) ) {
			$ids = explode(',', $gallery['ids']);

			$images = array();
			foreach ( $ids as $id ) {
				$image = wp_get_attachment_image_src( $id, 'full' );
				$img['url'] = $image[0];
				$img['alt'] = trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) );
				if ( empty( $img['alt'] ) ) { $img['alt'] = 'Image'; }

				if ( !empty( $img['url'] ) ) { $images[] = $img; }
			}
		}

		if ( !empty( $images ) ) {
			return $images;
		} else {
			return false;
		}
	}
}



/**
 * Cut string
 *
 * @param  [string]		$str		String, that must be cutted
 * @param  [int]		$size		Symbols
 *
 * @return [string]		cutted string
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_cut_string' ) ) {
	function lychee_cut_string( $str, $size ) {
		if ( strlen( $str ) > $size ) {
			$new_str = substr( $str, 0, $size );
			$sized = $size - 30;
			$pos = strrpos( $new_str, " ", $sized );
			$done_str = substr( $new_str, 0, $pos );
			$done_str .= '...';
			return $done_str;
		} else {
			return $str;
		}
	}
}



/**
 * Get the lychee theme comments form
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_comment_form' ) ) {
	function lychee_comment_form() {
		$req = $aria_req = true;
		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();

			if ( get_user_meta( $user_id, 'first_name' ) == '' && get_user_meta( $user_id, 'last_name', true ) == '' ) {
				$user_name = 'value="' . get_user_meta( $user_id, 'display_name', true ) . '"';
			} else {
				$user_name = 'value="' . get_user_meta( $user_id, 'first_name', true ) . " " . get_user_meta( $user_id, 'last_name', true ) . '"';
			}
			$user_email = 'value="' . get_user_meta( $user_id, 'user_email', true ) . '"';
		} else {
			$user_name = $user_email = '';
		}

		$lychee_comment_args = array(
			'title_reply'			=> __('LEAVE YOUR COMMENT', 'lychee'),
			'fields'				=> apply_filters( 'comment_form_default_fields', array(
				'author'				=> '<input type="text" placeholder="' . __( 'Name*', 'lychee' ) . '" name="author" ' . $user_name . ' id="field-1" required="required" />',
				'email'					=> '<input type="text" placeholder="' . __( 'Email *', 'lychee' ) . '" name="email" ' . $user_email . ' id="field-2" required="required" />',
				'url'					=> '',
			) ),
			'comment_field'			=> '<textarea id="field-3" placeholder="' . __( 'Message', 'lychee' ) . '" name="comment" required="required"></textarea>',
			'comment_notes_before'	=> '',
			'comment_notes_after'	=> '',
			'label_submit'			=> __( 'Send Message', 'lychee' ),
		);
		ob_start();
		comment_form( $lychee_comment_args );
		print str_replace('class="comment-respond"','class="contact-form"',ob_get_clean());
	}
}

function lychee_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

	<div class="comm-block comment-content">
	

		<div class="comm-img">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>

		<div class="comm-txt">
			<h5><?php printf( __( '%s', 'lychee' ), get_comment_author_link() ); ?></h5>
			<div class="date-post">
				<span class="fa fa-calendar"></span>
				<?php $originalDate = get_comment_date();
				$newDate = date("M d, Y", strtotime($originalDate)); ?>
				<h6><?php print $newDate;?></h6>
			</div>

			<div class="main-cont">
				<?php comment_text(); ?>
			</div>

			<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</div>
	
	</div>

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

if ( ! function_exists( 'lychee_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Twenty Fifteen 1.0
 */
function lychee_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'lychee' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'lychee' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'lychee' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;



/**
 * Get header nav menu
 *
 * @return [string/null]			if print == false return html code / else return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_primary_nav' ) ) {
	function lychee_primary_nav( $print = true ) {


		if ( has_nav_menu( 'pri-menu') ) {
			print '<div class="nav-menu-icon"><a href="#"><i></i></a></div>';
			$walker = new LycheePrimaryNavWalker();
			$primary_nav_args = array(
				'theme_location'	=> 'pri-menu',
				'container'			=> 'nav',
				'container_class'	=> 'menu',
				'echo'				=> $print,
				'before'            => ' ',
				'after'             => ' ',
				'link_before'       => ' ',
				'link_after'        => ' ',
				'fallback_cb'		=> 'wp_page_menu',
				'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'walker'			=> $walker,
			);
			wp_nav_menu( $primary_nav_args );
		} else {
			print '<nav><span class="no-menu">Please register Primary Menu from <a href="' . esc_url( admin_url('nav-menus.php') ) . '" target="_blank">Appearance &gt; Menus</a></span></nav>';
		}
	}
}

/**
 * Ajax update shoping cart
 *
 * @package lychee
 * @since 1.0.0
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'lychee' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'lychee' ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

/**
 * Get footer nav menu
 *
 * @return [string/null]			if print == false return html code / else return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_footer_nav' ) ) {
	function lychee_footer_nav( $print = true ) {

		$walker = new lycheeFooterNavWalker();
		$footer_menu_nav_args = array(
			'theme_location'	=> 'footer-menu',
			'container'			=> '',
			'echo'				=> $print,
			'before'          => ' ',
			'after'           => ' ',
			'link_before'     => ' ',
			'link_after'      => ' ',
			'fallback_cb'		=> 'wp_page_menu',
			'items_wrap'		=> '<ul class="footer-menu">%3$s</ul>',
			'walker'			=> $walker,
		);
		if ( has_nav_menu( 'footer-menu' ) ) {
			wp_nav_menu( $footer_menu_nav_args );
		} else {
			print '<nav><span class="no-menu">Please register Footer Menu from <a href="' . esc_url( admin_url('nav-menus.php') ) . '" target="_blank">Appearance &gt; Menus</a></span></nav>';
		}
	}
}


//  * Get site options
//  *
//  * @package lychee
//  * @since 1.0.0
//  */
if (! function_exists('cs_get_option')) {
  function cs_get_option(){
   return false;
  }
}
if ( !function_exists( 'lychee_get_options' ) ) {
  function lychee_get_options() {
    global $lychee_opt;
    defined( 'CS_OPTION' )  or  define( 'CS_OPTION',  'cs-framework' );
    $lychee_opt = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );
  }
  add_action( 'wp', 'lychee_get_options' );
}

/**
 * Get site subheader logo
 *
 * @return [null/string]			if print == true return null / else return html code
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_sublogo' ) ) {
	function lychee_sublogo( $print = true ) {
		global $lychee_opt;
		if ( is_object( $lychee_opt ) && $lychee_opt->get_sublogo() ) {
			$output = '<a id="subheader-logo" href="' . esc_url( home_url('/') ) . '"><img src="' . esc_url( $lychee_opt->get_logo() ) . '" alt="Sub-logo" /></a>';
			if ( $print ) { print $output; } else { return $output; }
		}
	}
}



/**
 * Get footer social icons
 *
 * @return [null/string]			if print == true return null / else return html code
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_footer_socials' ) ) {
	function lychee_footer_socials( $print = true ) {
		global $lychee_opt;
		if ( is_object( $lychee_opt ) && $lychee_opt->get_socials() ) {
			$socials = $lychee_opt->get_socials();
			$output = '<div class="row nopadding social-icons-wrapper">';
			foreach ($socials as $social) {
				$output .= '<div class="col-xs-3 nopadding"><a class="social-icon" href="' . esc_url( $social['link'] ) . '" target="_blank" title="' . esc_attr( $social['title'] ) . '" style="background-color: ' . esc_attr( $social['color'] ) . ';"><i class="' . esc_attr( $social['icon'] ) . '"></i></a></div>';
			}
			$output .= '</div>';
			if ( $print ) { print $output; } else { return $output; }
		}
	}
}



/**
 * Get post categories
 *
 * @return [null/string]			if print == true return null / else return html code
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_post_categories' ) ) {
	function lychee_post_categories( $separator = ' ', $post_id = null, $print = true ) {
		if ( $post_id === null ) {
			global $post;
			$post_id = $post->ID;
		}

		$output = '';

		$categories = get_the_category( $post_id );
		if ( $categories ) {
			$i = 0;
			foreach( $categories as $category ) {
				$output .= ( $i++ > 0 ) ? $separator : '';
				$output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'lychee' ), $category->name ) ) . '">' . esc_attr( $category->cat_name ) . '</a>';
			}
		}

		$output = trim( $output );
		if ( $print ) { print $output; } else { return $output; }
	}
}



/**
 * Get post views count
 *
 * @return [null/string]			if print == true return null / else return html code
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_post_views' ) ) {
	function lychee_post_views( $post_id = null, $print = true ) {
		if ( $post_id === null ) {
			global $post;
			$post_id = $post->ID;
		}

		$count_key = 'post_views_count';
		$count = get_post_meta( $post_id, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
			$count = 0;
		}
		return $count;
	}
}



/**
 * Set post views
 *
 * @return [null/string]			if print == true return null / else return html code
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_set_post_views' ) ) {
	function lychee_set_post_views( $post_id = null ) {
		if ( $post_id === null ) {
			global $post;
			$post_id = $post->ID;
		}

		$count_key = 'post_views_count';
		$count = get_post_meta( $post_id, $count_key, true );
		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
		} else {
			$count++;
			update_post_meta( $post_id, $count_key, $count );
		}
	}
}


/**
 * Test if user already liked post
 * @param	[int]		$post_id Post ID
 *
 * @return	[bool]		true if already liked, false on the other way
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_post_already_liked' ) ) {
	function lychee_post_already_liked( $post_id ) { // test if user liked before
		if ( is_user_logged_in() ) { // user is logged in
			$user_id = get_current_user_id(); // current user
			$meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
			$liked_USERS = ""; // set up array variable

			if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
				$liked_USERS = $meta_USERS[0];
			}

			if( !is_array( $liked_USERS ) ) // make array just in case
			$liked_USERS = array();

			if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array
				return true;
			}
			return false;

		} else { // user is anonymous, use IP address for voting

			$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
			$ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
			$liked_IPS = ""; // set up array variable

			if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
				$liked_IPS = $meta_IPS[0];
			}

			if ( !is_array( $liked_IPS ) ) // make array just in case
			$liked_IPS = array();

			if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
				return true;
			}
			return false;
		}

	}
}



/**
 * Front end like button
 *
 * @return [string]		html code of like button
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_post_like_link' ) ) {
	function lychee_post_like_link( $post_id, $print = true ) {
		$like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
		$count = ( empty( $like_count ) || $like_count == "0" ) ? '0' : esc_attr( $like_count );
		if ( lychee_post_already_liked( $post_id ) ) {
			$class = esc_attr( ' liked' );
			$title = esc_attr( 'Unlike it :(' );
		} else {
			$class = esc_attr( '' );
			$title = esc_attr( 'Like it :)' );
		}
		$output = '<div class="data-entry"><span class="icon-entry like lychee-post-like' . $class . '" data-post_id="' . $post_id . '" title="' . $title . '"></span><br> <span class="counter">' . $count . '</span></div>';
		if ( $print ) { print $output; } else { return $output; }
	}
}



/**
 * Custom post thumbnail
 *
 * @return [string/bool]		if print == false return html img code / else return false
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_post_thumbnail' ) ) {
	function lychee_post_thumbnail( $post_id = null, $class = '', $print = true ) {
		if ( $post_id === null ) {
			global $post;
			$post_id = ( is_object( $post ) && isset( $post->ID ) ) ? $post->ID : false;
		}

		if ( $post_id && has_post_thumbnail( $post_id ) ) {
			$image_id = get_post_thumbnail_id( $post_id );
			$image =  wp_get_attachment_image_src( $image_id, 'full' );
			if ( !empty( $image ) ) {
				if ( ( $image[2] <= $image[1] ) ) {
					$img = get_the_post_thumbnail( $post_id, 'full', array( 'class' => $class ) );
				} else {
					$width = $image[1];
					$height = intval( $image[1] * 0.75 );
					$src = aq_resize( $image[0], $width, $height, true, true, true );
					$img = get_the_post_thumbnail( $post_id, 'full', array( 'src' => $src, 'class' => $class ) );
				}
			}
		} else {
			$img = false;
		}
		if ( $print ) { print $img; } else { return $img; }
	}
}



/**
 * Custom size post thumbnail
 *
 * @return [string/bool]		if print == false return html img code / else return false
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_custom_thumbnail' ) ) {
	function lychee_custom_thumbnail( $post_id, $width, $height, $class = '', $print = true ) {
		if ( $post_id === null ) {
			global $post;
			$post_id = ( is_object( $post ) && isset( $post->ID ) ) ? $post->ID : false;
		}

		if ( $post_id && has_post_thumbnail( $post_id ) ) {
			$image_id = get_post_thumbnail_id( $post_id );
			$image =  wp_get_attachment_image_src( $image_id, 'full' );
			if ( $image ) {
				$src = aq_resize( $image[0], $width, $height, true, true, true );
				$img = get_the_post_thumbnail( $post_id, 'full', array( 'src' => $src, 'class' => $class ) );
			}
		} else {
			$img = false;
		}
		if ( $print ) { print $img; } else { return $img; }
	}
}



/**
 * Get related posts
 *
 * @param  [integer] $post_id   ID of post
 * @param  [integer] $posts_qty Number of related posts, that we need to get
 *
 * @return [array] Array with related posts in success, [bool] false in failure
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_get_related_posts' ) ) {
	function lychee_get_related_posts( $posts_qty = 4, $post_id = NULL ) {
		if ( $post_id === null ) {
			global $post;
			$post_id = ( is_object( $post ) && isset( $post->ID ) ) ? $post->ID : false;
		}

		$related_posts_args = array(
			'category__in' => wp_get_post_categories( $post_id ),
			'numberposts' => $posts_qty,
			'post__not_in' => array( $post_id ),
		);

		$related = get_posts( $related_posts_args );
		return ( $related ) ? $related : false;
	}
}


/**
 * Display navigation to next/previous comments when applicable.
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_comment_nav' ) ) {
	function lychee_comment_nav() {

		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<nav class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'lychee' ); ?></h2>
			<div class="nav-links">
				<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'lychee' ) ) ) {
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				}

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'lychee' ) ) ) {
					printf( '<div class="nav-next">%s</div>', $next_link );
				} ?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		}
	}
}


/**
 * Add new field to tags and categories
 *
 * @package lychee
 * @since 1.0.0
 */
function lycheecategory_fields($tag) {
   //check for existing taxonomy meta for term ID
    $t_id = $tag->term_id;
    $term_meta = get_option( "taxonomy_$t_id");
?>
<tr class="form-field">
	<th scope="row" valign="top"><label for="cat_Image_url"><?php esc_html_e('Intro background image', 'lychee'); ?></label></th>
	<td>
		<input type="text" name="term_meta[img]" id="term_meta[img]" size="3" style="width:60%;" value="<?php echo $term_meta['img'] ? $term_meta['img'] : ''; ?>"><br />
		<span class="description"><?php _e('Image for Term: use full url', 'lychee'); ?></span>
	</td>
</tr>
<tr class="form-field">
	<th scope="row" valign="top"><label for="cat_intro_title"><?php _e('Category intro title', 'lychee'); ?></label></th>
	<td>
		<input type="text" name="term_meta[cat_intro_title]" id="term_meta[cat_intro_title]" size="25" style="width:60%;" value="<?php echo $term_meta['cat_intro_title'] ? $term_meta['cat_intro_title'] : ''; ?>">
	</td>
</tr>
<tr class="form-field">
	<th scope="row" valign="top"><label for="cat_intro_subtitle"><?php _e('Category intro subtitle', 'lychee'); ?></label></th>
	<td>
		<input type="text" name="term_meta[cat_intro_subtitle]" id="term_meta[cat_intro_subtitle]" size="25" style="width:60%;" value="<?php echo $term_meta['cat_intro_subtitle'] ? $term_meta['cat_intro_subtitle'] : ''; ?>">
	</td>
</tr>
<?php
}
 
// save extra taxonomy fields callback function
function save_lychee_category_fileds( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id");
        $cat_keys = array_keys($_POST['term_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['term_meta'][$key])){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        //save the option array
        update_option( "taxonomy_$t_id", $term_meta );
    }
}

add_action ( 'edit_category_form_fields', 'lycheecategory_fields');
add_action ( 'post_tag_edit_form_fields', 'lycheecategory_fields', 10, 2);
add_action ( 'portfolio-category_edit_form_fields', 'lycheecategory_fields', 10, 2);

add_action ( 'edited_category', 'save_lychee_category_fileds');
add_action( 'edited_post_tag', 'save_lychee_category_fileds', 10, 2);
add_action( 'edited_portfolio-category', 'save_lychee_category_fileds', 10, 2);


/**
 * Category Intro Section
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_intro_sec' ) ) {
	function lychee_intro_sec($idCat) { 
		$term_data = get_option("taxonomy_$idCat"); ?>

		<?php if(!empty($term_data['img'])){?>
		<div class="top-baner half-height">
			
			<?php if(!empty($term_data['img'])) { ?>
			<div class="clip">
				<div class="bg bg-bg-chrome" style="background-image:url(<?php print esc_attr($term_data['img']); ?>)"></div>
			</div>
			<?php } ?>

			<div class="main-title">
				<?php if(!empty($term_data['cat_intro_title'])) print "<h2>".esc_attr($term_data['cat_intro_title'])."</h2>"; ?>
				<?php if(!empty($term_data['cat_intro_subtitle'])) print "<h5>".esc_attr($term_data['cat_intro_subtitle'])."</h5>"; ?>
			</div>
		</div>
		<?php }

	}
}


/**
 * Shop Intro Section
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if ( !function_exists( 'lychee_shop_intro_sec' ) ) {
	function lychee_shop_intro_sec() { 
		
		$is_intro_on = cs_get_option('shop_show_user_intro');

		if(is_product_category()){
			global $wp_query;
			$cat = $wp_query->get_queried_object();
			$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );

			$prod_term=get_term($cat->term_id,'product_cat');
			$description=$prod_term->description;

			$shop_intro_img = ( $image ) ? $image : '';
			$shop_intro_title = single_term_title( "", false );
			$shop_intro_subtitle = $description;

		} else {
			$shop_intro_img_id = cs_get_option('shop_user_intro_background_image');
			$shop_intro_img_data = wp_get_attachment_image_src($shop_intro_img_id, 'full');
			$shop_intro_img = $shop_intro_img_data[0];
			$shop_intro_title = cs_get_option('shop_user_intro_title');
			$shop_intro_subtitle = cs_get_option('shop_user_intro_subtitle');
		}

		if($is_intro_on){?>
		<div class="top-baner half-height">
			
			<?php if($shop_intro_img) { ?>
			<div class="clip">
				<div class="bg bg-bg-chrome" style="background-image:url(<?php print esc_attr($shop_intro_img); ?>)"></div>
			</div>
			<?php } ?>

			<div class="main-title">
				<?php if(!empty($shop_intro_title)) print "<h2>".esc_attr($shop_intro_title)."</h2>"; ?>
				<?php if(!empty($shop_intro_subtitle)) print "<h5>".esc_attr($shop_intro_subtitle)."</h5>"; ?>
			</div>
		</div>
		<?php }

	}
}

/**
 * POST FORMAT: VIDEO & AUDIO
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if( ! function_exists( 'lychee_post_media' ) ) {
  function lychee_post_media( $content ) {

    $is_video = ( get_post_format() == 'video' ) ? true : false;
    $media    = lychee_get_first_url_from_string( $content );

    if( ! empty( $media ) ) {

      global $wp_embed;
      $content  = do_shortcode( $wp_embed->run_shortcode( '[embed]'. $media .'[/embed]' ) );

    } else {

      $pattern = lychee_get_shortcode_regex( lychee_tagregexp() );
      preg_match( '/'.$pattern.'/s', $content, $media );

      if ( ! empty( $media[2] ) ) {

        if( $media[2] == 'embed' ) {
          global $wp_embed;
          $content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
        } else {
          $content = do_shortcode( $media[0] );
        }

      }

    }

    if( ! empty( $media ) ) {

      return $content;

    }

    return false;
  }
}

/**
 * Pagination
 *
 * @return null
 *
 * @package lychee
 * @since 1.0.0
 */
if( ! function_exists( 'lychee_post_pagination' ) ) {
  function lychee_post_pagination() {
		$paginator = get_the_posts_pagination( array(
			'mid_size' => 3,
			'prev_text' => '<span class="fa fa-angle-left"></span>',
			'next_text' => '<span class="fa fa-angle-right"></span>',
			'screen_reader_text' => '',
		) );
			$paginator = str_replace( 'class="next page-numbers', 'class="next button', $paginator );
			$paginator = str_replace( 'class="prev page-numbers', 'class="prev button', $paginator );
			$paginator = str_replace( 'class="navigation pagination', 'class="nav-bar', $paginator );

		$pagination_output  = '';
		if($paginator){
			$pagination_output .= '<div class="clear"></div>';
			$pagination_output .= $paginator;
		}

		return $pagination_output;

  }
}