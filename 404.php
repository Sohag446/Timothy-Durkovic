<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Timothy_Durkovic
 */

get_header();
?>


	<main id="primary" class="site-main">
	
		<section class="error-404 not-found">
			<div class="container">
				
				<div class="error-page-content">
					<h1>404</h1>
					<p><?php esc_html_e( 'Nothing was found at this location.', 'East_86th_Street' ); ?></p>
					<a href="/" class="primary-btn center">Go back to Home</a>

					<?php //get_search_form(); ?>

				</div>

			</div>
		</section>

	</main>

<?php
get_footer();
