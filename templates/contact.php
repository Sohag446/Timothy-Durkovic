<?php
/**
* Template Name: Contact
*/

get_header();

$short_notes = get_field('short_notes');
$form_id = get_field('form_id');
$social_section = get_field('social_section');


$fb = $social_section['facebook'];
$li = $social_section['linkedin'];
$insta = $social_section['instagram'];
$email = $social_section['email'] ? $social_section['email'] : 'timothydurkovic@me.com';
$img = $social_section['right_side_image'];

?>

<section class="contact-template">
    <div class="container">
        <div class="contact-inner">
            <?php the_title( '<h1 class="conact-title txt-center">', '</h1>' ); ?>
            <h4 class="info txt-center"><?php echo $short_notes; ?></h4>

            <div class="form-container">
                <?php echo do_shortcode('[gravityform id="'.$form_id.'" title="false" ajax="true"]'); ?>
            </div>

        </div>
    </div>
</section>


<section class="contact-social-section">
    <div class="contact-social-inner">
        <div class="contact-social">
            <?php if($fb || $li || $insta ) { ?>
                <div class="social">
                    <h5>Social</h5>

                    <div>
                        <?php 
                            if($fb) {
                                echo '<a href="'.$fb.'" target="_blank"><i class="fa-brands fa-facebook"></i></a>';
                            }
                            if($li) {
                                echo '<a href="'.$li.'" target="_blank"><i class="fa-brands fa-linkedin"></i></a>';
                            }

                            if($insta) {
                                echo '<a href="'.$insta.'" target="_blank"><i class="fa-brands fa-instagram"></i></a>';
                            }

                        ?>
                    </div>

                </div>
            <?php } ?>

            <div class="email-con">
                <h5>Email</h5>
                <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
            </div>
        </div>
        <div class="contact-social-img-con">
            <?php 
            if($img) {
                echo '<img src="'.$img.'"/>';
            }
            ?>
        </div>
    </div>
</section>





<?php  get_footer(); ?>