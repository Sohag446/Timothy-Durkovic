<?php
/**
 * The template for displaying Post archive pages
 *
 */

get_header();
?>

<main id="events-archive" class="site-main">
		<div class="container">
			<div class="events-archive-inner">
				<h1 class="archive-title">Calendar</h1>
				<?php if ( have_posts() ) {

					$selected_cat = get_field('calender_filter','option');
					
					echo '<div class="all-tab-cat">';
					echo 	'<div class="sgl-cat active" id="cat-all">All</div>';
					foreach($selected_cat as $cat) {
						$cat_full_name = get_field('category_full_name', $cat);
						$cat_name = $cat_full_name ? $cat_full_name : $cat->name;
						echo 	'<div class="sgl-cat" id="cat-'.$cat->term_id.'">'.$cat_name.'</div>';
					}
					echo '</div>';



					echo '<div class="events-list all-events">';
					while ( have_posts() ) : the_post(); 

						$loc = get_field('location', get_the_ID());
						$city = $loc['city'];
						$street = $loc['street'];
						$time = get_field('time', get_the_ID());
						$date = get_field('date', get_the_ID());
						$day = date('j', strtotime($date));
                        $month = date('M', strtotime($date));
						$venue = get_field('venue', get_the_ID());
						$p_info = get_field('program_info', get_the_ID());
						$tickets = get_field('buy_ticket', get_the_ID());
						$featuring = get_field('featuring', get_the_ID()); 

						$categories = get_the_category(get_the_ID());
						$loc_color = get_field('event_heading_background', get_the_ID()); 
						$loc_text = ($loc_color == 'brown') ? '--white': '--tobacoo';
						

					
						?>
						
						<div class="single-event sgl-cat-all sgl-cat-<?php echo $categories[0]->term_id; ?>">
							<div class="event-inner">
								<div class="sgl-event-hd">
									<div class="event-date">
										<?php echo $date ? '<h3 class="day">'.$day.'</h3>' : '';?>
										<?php echo $date ? '<div class="month">'.$month.'</div>' : '';?>
										
									</div>
									<div class="location" style="background-color: var(<?php echo '--'.$loc_color;?>);">
										<?php echo $city ? '<p style="color:var('.$loc_text.')">'.$city.'</p>' : '';?>
										<?php echo $time ? '<p style="color:var('.$loc_text.')"><strong>'.$time.'</strong></p>' : '';?>
									</div>
								</div>

								<div class="event-info-con">
									
									<div class="venue">
										<h5 class="event-info-hd">Venue</h5>
										<h5><?php echo $venue ? $venue : the_title(); ?></h5>
										<?php echo $street ? '<p class="street">'.$street.'</p>' : '';?>
										<?php echo $city ? '<p class="city">'.$city.'</p>' : '';?>
									</div>
									

									<?php if($p_info){ ?>
										<div class="p_info">
											<h5 class="event-info-hd">Program Info</h5>
											<p><?php echo $p_info; ?></p>
										</div>
									<?php } ?>


									<?php if($featuring){ ?>
										<div class="featuring">
											<h5 class="event-info-hd">Featuring</h5>
											<?php
											foreach($featuring as $f){
												echo '<p><strong>'.$f['performer'].',</strong> '.$f['performance'].'</p>';
											} 
											?>
										</div>
									<?php } ?>


									<?php if($tickets){ ?>
										<div class="ticket-btn-con">
											<a href="<?php echo $tickets; ?>" class="btn white" target="_blank">Buy Tickets</a>
										</div>
									<?php } ?>


								</div>
							</div>
						</div>


						<?php 
					endwhile;
					echo '</div>';

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
