<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Timothy_Durkovic
 */

get_header();
?>

	<main id="recording-archive" class="site-main">
		<div class="container">
			<div class="recording-archive-inner">
				<h1 class="archive-title">Recordings</h1>
				<?php if ( have_posts() ) {

					echo '<div class="recording-list">';
					while ( have_posts() ) :
						the_post();

						$ft_img = wp_get_attachment_url(get_post_thumbnail_id());
						$info = get_field('info', get_the_ID());
						$s_info = get_field('short_info', get_the_ID());
						$performers = get_field('performers', get_the_ID());
						$rec_link = get_field('recording_link', get_the_ID());

						?>
						
						<div class="single-record">
							<div class="ft-img-con">
								<img src="<?php echo $ft_img; ?>"/>
							</div>
							<div class="record-content">
								<div class="title-con">
									<h3><?php the_title(); ?></h3>
								</div>

								<div class="rec-infos">
									<div>
										<h5 class="performers">
											<?php 
											foreach($performers as $p) {
												echo '<span>'.$p['performer'].'</span>';
												echo '<span> | </span>';
											}
											
											?>
										</h5>
										<p class="info"><?php echo $info; ?></p>
										<p class="short-info"><?php echo $s_info; ?></p>
									</div>

									<div class="recording-links">
										<?php  if($rec_link['itunes']){ ?>
											<a href="<?php echo $rec_link['itunes']; ?>" target="_blank">
												<img src="<?php echo get_template_directory_uri() . '/assets/img/itune.png'; ?>"/>
											</a>
											
										<?php }

										if($rec_link['cdbaby']){ ?>
											<a href="<?php echo $rec_link['cdbaby']; ?>" target="_blank">
												<img src="<?php echo get_template_directory_uri() . '/assets/img/cdbaby.png'; ?>"/>
											</a>
										<?php } ?>
									</div>

								</div>
									

							</div>
						</div>

						<?php 



					endwhile;
					echo '</div>';

					the_posts_navigation();

				} else {
					get_template_part( 'template-parts/content', 'none' );
				}

				?>
			</div>
		</div>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
