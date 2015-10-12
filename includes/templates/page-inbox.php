<section id="primary" class="content-area page-inbox">
	<main id="main" class="site-main" role="main">
		<?php
		if ( get_option( 'show_messaging', 0 ) == 1 ) {
			echo do_shortcode( '[messaging_submenu]' );
			if ( function_exists( 'messaging_inbox_page_output' ) ) {
				?>
				<div class="cp_messaging_wrap"><?php messaging_inbox_page_output(); ?></div>
			<?php
			} else {
				_e( 'Messaging plugin is not active.', 'coursepress_base_td' );
			}
		} else {
			_e( 'Messaging is not allowed.', 'coursepress_base_td' );
		}
		?>
	</main>
	<!-- #main -->
</section><!-- #primary -->