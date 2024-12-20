<?php
/**
* Template Name: About
*/

get_header();

$banner = get_field('banner');
$ft_img = wp_get_attachment_url(get_post_thumbnail_id());

?>

<!-- Banner -->
<section class="abt-banner">
    <img src="<?php echo $banner ? $banner : $ft_img; ?>"/>
</section>


<!-- Content -->
 <?php

if (have_rows('content')) {
    while (have_rows('content')) : the_row();

        // Content
        if (get_row_layout() == 'content') {
            $heading = get_sub_field('heading');
            $center_content = get_sub_field('center_content');
            $column_content = get_sub_field('column_content'); 
            $column_content_2 = get_sub_field('column_content_2'); 
            $quote = $column_content_2['quote']; ?>


            <section class="abt-content-section">
                <div class="container">
                    <div class="abt-content-wrapper">
                        <h1 class="txt-center"><?php echo $heading ? $heading : the_title(); ?></h1>
                        <div class="center-content">
                            <?php echo $center_content ;?>
                        </div>

                        <div class="column-content">
                            <div class="column-1"><?php echo $column_content['content'];?></div>

                            <div class="column-2">
                                <?php echo $column_content_2['content'];?>
                                <?php if($quote['quote'] || $quote['name'] ) { ?>
                                    <div class="quote-con">
                                        <div class="quote-icon">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/red-quote.png'; ?>"/>
                                        </div>
                                        <h4><?php echo $quote['quote'];?></h4>
                                        <h5><?php echo $quote['name'];?></h5>
                                    </div>
                                <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <?php 
        }











        // Recognition
        if (get_row_layout() == 'recognition') {
            $heading = get_sub_field('heading');
            $competition = get_sub_field('competition'); ?>

            <section class="recognition-section">
                <div class="container">
                    <div class="recognition-wrapper">
                        <h2><?php echo $heading; ?></h2>
                        <div class="recognition-slider">
                            <?php
                            foreach($competition as $c) { ?>

                                <div class="rec-item">
                                    <h5><?php echo $c['competition_name'];?></h5>
                                    <h6><?php echo $c['achievement'];?></h6>
                                </div>
                                
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
            </section>

            <?php 

        }




        // Photo Quote
        if (get_row_layout() == 'photo_quote') {
            $quote = get_sub_field('quote');
            $image = get_sub_field('image'); ?>

            <section class="photo-quote-section">
                <div class="photo-quote-inner">
                    <div class="quote-container">
                        <div class="quote-inner">
                            <div class="quote-icon">
                                <img src="<?php echo get_template_directory_uri() . '/assets/img/white-quote.png'; ?>"/>
                            </div>
                            <h4><?php echo $quote['quote'];?></h4>
                            <h5><?php echo $quote['name'];?></h5>
                        </div>
                    </div>

                    <div class="img-container">
                        <img src="<?php echo $image; ?>"/>
                    </div>
                </div>
            </section>

            <?php
        }




        // Content With Button
        if (get_row_layout() == 'center_content_with_button') {
            $heading = get_sub_field('heading');
            $description = get_sub_field('description');
            $button = get_sub_field('button'); ?>

            <section class="center-content-section">
                <div class="container">
                    <div class="center-content-wrapper">
                        <h2 class="txt-center"><?php echo $heading ; ?></h2>
                        <div class="description txt-center"><?php echo $description ; ?></div>

                        <?php
                        if( $button ) {
                            $link_url = $button['url'];
                            $link_title = $button['title'];
                            $link_target = $button['target'] ? $button['target'] : '_self';
                            ?>
                            <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </section>
            
            <?php 
        }

    endwhile;
}
 
 
 
 
 
 
 ?>







<?php  get_footer(); ?>