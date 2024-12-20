<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Timothy_Durkovic
 */


 $footer = get_field('footer','options');
 $sm_links = $footer['social_media_link'];
 $copy_right_text = $footer['copy_right_text'];
 $bg = $footer['background'];



?>

	<footer id="footer" class="site-footer" style="background-image:url(<?php echo $bg;?>); ">
		<div class="container">
			<div class="footer-inner">

				<div class="footer-col">
					<div class="footer-logo">
						<a href="/">
							<?php
								$footer_logo = get_theme_mod('footer_logo');
								if ($footer_logo) {
									echo '<img src="' . esc_url($footer_logo) . '" alt="Footer Logo">';
								} else {
									echo '<img src="' . get_template_directory_uri() . '/assets/img/logo-white.svg" alt="Footer Logo">';
								}
							?>
						</a>
					</div>

					<div class="footer-main-menu">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'menu_id'        => 'footer-menu',
								)
							);
						?>
					</div>
				</div>


				<div class="footer-col footer-menu-con">
					<div class="social-media">
						<?php
						if($sm_links['facebook']) {
							echo '<a href="'.$sm_links['facebook'].'" target="_blank"><i class="fa-brands fa-facebook"></i></a>';
						}
						if($sm_links['linkedin']) {
							echo '<a href="'.$sm_links['linkedin'].'" target="_blank"><i class="fa-brands fa-linkedin"></i></a>';
						}

						if($sm_links['instagram']) {
							echo '<a href="'.$sm_links['instagram'].'" target="_blank"><i class="fa-brands fa-instagram"></i></a>';
						}
						?>
					</div>

					<div class="ft-secondary-menu-con">
						<div class="ft-sec-menu-con-inner">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer-2',
										'menu_id'        => 'footer-sec-menu',
									)
								);
							?>
							<div class="copy-right-info">Timothy Durkovic Copyright ©<?php echo date("Y"); ?></div>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</footer>






</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
