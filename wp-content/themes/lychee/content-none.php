<?php
/**
* Post no found
*
* @package lychee
* @since 1.0.0
*
*/
?>


<div class="main-wrapp pad120"> 
	<div class="container">
		<div class="row">	
			<div class="col-md-12">
				<div class="subtitle">
					
					<h3><?php esc_html_e( 'Nothing Found', 'lychee' ); ?></h3>

					<?php if(is_search()){?>
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lychee' ); ?></p>
					<?php } else { ?>
						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'lychee' ); ?></p>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
</div>