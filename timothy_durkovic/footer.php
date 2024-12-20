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

 $ft_img = get_template_directory_uri().'/assets/img/footer_backgound.jpg';
 $ft_bg = $bg ? $bg : $ft_img;


?>

	<footer id="footer" class="site-footer" style="background:url(<?php echo $ft_bg;?>); ">
		<div class="container">
			<div class="footer-inner">

				<div class="footer-logo">
					<?php
						$footer_logo = get_theme_mod('footer_logo');
						if ($footer_logo) {
							echo '<img src="' . esc_url($footer_logo) . '" alt="Footer Logo">';
						} else {
							echo '<img src="' . get_template_directory_uri() . '/assets/img/logo-white.svg" alt="Footer Logo">';
						}
					?>
				</div>

				<div class="social-media">

				</div>
				
			</div>
		</div>
	</footer>






</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
