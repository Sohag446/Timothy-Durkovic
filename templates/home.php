<?php
/**
 * Template Name: Home
 */

get_header();

// Home Content

// Banner
$image = get_field('banner_image');
?>

<div class="banner">
    <?php
    if ($image) {
        $final_image = $image;
    } elseif (has_post_thumbnail()) {
        $final_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } else {
        $final_image = get_template_directory_uri() . '/assets/img/banner.jpg';
    }
    ?>

    <?php if ($final_image) { ?>
        <img src="<?php echo esc_url($final_image); ?>" alt="Banner Image">
    <?php } ?>
</div>

<?php

if (have_rows('home_content')) {
    while (have_rows('home_content')) : the_row();

        if (get_row_layout() == 'about_artist') {
            $header = get_sub_field('header');
            $document = get_sub_field('document');
            $button = get_sub_field('button');
            ?>

            <div class="about_artist">
                <div class="container">
                    <div class="about_artist_body">
                        <?php if ($header) { ?>
                            <h1><?php echo esc_html($header); ?></h1>
                        <?php } ?>
                        <?php if ($document) { ?>
                            <p><?php echo esc_html($document); ?></p>
                        <?php } ?>
                        <div class="artist_button">
                            <?php if ($button) {
                                $btn_url = $button['url'];
                                $btn_title = $button['title'];
                                $btn_target = $button['target'] ? $button['target'] : '_self';
                                echo '<a href="' . esc_url($btn_url) . '" class="btn white" target="' . esc_attr($btn_target) . '">' . esc_html($btn_title) . '</a>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

        if (get_row_layout() == 'upcoming_concerts') {
            $header = get_sub_field('header');
            $button = get_sub_field('button');
            $event_button = get_sub_field('event_button');
            ?>
            <div class="upcoming_concerts">
                <div class="container">
                    <div class="upcoming_concerts_body">
                        <div class="concert_about">
                            <div class="concert_about_header">
                                <?php if ($header) {
                                    echo '<h2>' . esc_html($header) . '</h2>';
                                } ?>
                            </div>
                            <div class="concert_about_btn">
                                <?php if ($button) {
                                    $btn_url = $button['url'];
                                    $btn_title = $button['title'];
                                    $btn_target = $button['target'] ? $button['target'] : '_self';
                                    echo '<a href="' . esc_url($btn_url) . '" class="btn white" target="' . esc_attr($btn_target) . '">' . esc_html($btn_title) . '</a>';
                                } ?>
                            </div>
                        </div>
                        <div class="concerts">

                        <?php
                            if ($event_button == 'default') { ?>
                                <div class="concert_body">
                                    <?php
                                    $categories = get_categories(array(
                                        'orderby' => 'name',
                                        'order'   => 'DESC',
                                    ));

                                    $displayed_posts = 0;
                                    $max_posts = 3;

                                    foreach ($categories as $category) {
                                        if ($displayed_posts >= $max_posts) break;

                                        $args = array(
                                            'post_type'      => 'post',
                                            'posts_per_page' => $max_posts - $displayed_posts,
                                            'orderby'        => 'date',
                                            'order'          => 'ASC',
                                            'category__in'   => $category->term_id,
                                        );

                                        $query = new WP_Query($args);

                                        if ($query->have_posts()) {
                                            echo '<div class="categories">';
                                            echo '<h4>' . esc_html($category->name) . '</h4>';
                                            echo '</div>';

                                            foreach ($query->posts as $post) {
                                                $date = get_field('date', $post->ID);
                                                $day = date('j', strtotime($date));
                                                $month = date('F', strtotime($date));
                                                $venue = get_field('venue', $post->ID);
                                                $location = get_field('location', $post->ID);
                                                $city = isset($location['city']) ? $location['city'] : '';
                                                $loc_color = get_field('event_heading_background', get_the_ID()); 
						                        $loc_text = ($loc_color == 'brown') ? '--white': '--tobacoo';
						

                                                ?>
                                                <div style="background-color: var(<?php echo '--'.$loc_color;?>);" class="concert">
                                                    <div class="concert_inner">
                                                        <div class="concert_date">
                                                            <h3 class="concert_date_day"><?php echo esc_html($day); ?></h3>
                                                            <p class="concert_date_month"><?php echo esc_html(substr($month, 0, 3)); ?></p>
                                                        </div>
                                                        <div style="background-color: var(<?php echo '--'.$loc_color;?>);" class="concert_info">
                                                            <div class="concert_info_body">
                                                                <div class="concert_venue">
                                                                    <h5 style="color:var(<?php echo esc_html($loc_text); ?>)"><?php echo esc_html($venue); ?></h5>
                                                                </div>
                                                                <div class="concert_city">
                                                                    <h6><?php echo esc_html($city); ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $displayed_posts++;
                                                if ($displayed_posts >= $max_posts) break;
                                            }
                                        }

                                        wp_reset_postdata(); // Reset query
                                    }
                                    ?>
                                </div>
                            <?php


                            } elseif ($event_button == 'select') { ?>
                                <div class="concert_body">
                                    <?php
                                    $event_data = get_sub_field('event');

                                    if ($event_data) {
                                        foreach ($event_data as $post) {
                                            setup_postdata($post);
                                            $date = get_field('date', $post->ID);
                                            $day = date('j', strtotime($date));
                                            $month = date('F', strtotime($date));
                                            $venue = get_field('venue', $post->ID);
                                            $location = get_field('location', $post->ID);
                                            $city = isset($location['city']) ? $location['city'] : '';
                                            $loc_color = get_field('event_heading_background', get_the_ID()); 
						                    $loc_text = ($loc_color == 'brown') ? '--white': '--tobacoo';
						
                                            ?>
                                            <div style="background-color: var(<?php echo '--'.$loc_color;?>);" class="concert">
                                                <div class="concert_inner">
                                                    <div class="concert_date">
                                                        <h3 class="concert_date_day"><?php echo esc_html($day); ?></h3>
                                                        <p class="concert_date_month"><?php echo esc_html(substr($month, 0, 3)); ?></p>
                                                    </div>
                                                    <div style="background-color: var(<?php echo '--'.$loc_color;?>);" class="concert_info">
                                                        <div class="concert_info_body">
                                                            <div class="concert_venue">
                                                                <h5 style="color:var(<?php echo esc_html($loc_text); ?>)"><?php echo esc_html($venue); ?></h5>
                                                            </div>
                                                            <div class="concert_city">
                                                                <h6><?php echo esc_html($city); ?></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        wp_reset_postdata();
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

        if (get_row_layout() == 'people_saying') {
            $header = get_sub_field('header'); ?>

            <div class="people_saying">
                <div class="container">
                    <div class="people_saying_header">
                        <?php if ($header) {
                            echo '<h2>' . esc_html($header) . '</h2>';
                        } ?>
                    </div>

                    <div class="people_saying_message_body">
                        <?php
                        $args = array(
                            'post_type'      => 'review',
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                            'posts_per_page' => -1,
                        );

                        $query = new WP_Query($args);

                        $reviews = $query->posts;

                        if (!empty($reviews)) {
                            foreach ($reviews as $review) { ?>
                                <div class="people_saying_message">
                                    <div class="message">
                                        <p class="first_message_quotation">“</p>
                                        <div class="message_info">
                                            <h4>
                                                <?php echo esc_html(strip_tags($review->post_content)); ?>
                                                <span class="message_quotation">”</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="message_name">
                                        <h5><?php echo esc_html($review->post_title); ?></h5>
                                    </div>
                                </div>
                                <?php
                            }
                        } else { ?>
                            <p>No reviews found.</p>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
            </div>

            <?php
        }

    endwhile;
}
get_footer();
?>
