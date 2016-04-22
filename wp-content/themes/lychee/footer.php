<?php
/**
 * Footer
 *
 * @package lychee
 * @since 1.0.0
 *
 */
global $lychee_opt;

 if ( cs_get_option() === false || $lychee_opt['footer-copy-text'] ) { 
 	?>

 	<footer>
 		<div class="copyright">
 			<?php print $lychee_opt['footer-copy-text']; ?>
 		</div>
 	</footer>

 <?php  } ?>
	
	<?php wp_footer(); ?>
</body>
</html>