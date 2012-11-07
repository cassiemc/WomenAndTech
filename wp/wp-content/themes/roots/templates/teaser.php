<?php
/*

2 cases:

1- homepage or single post: get the previous interview to the current one
2- page or other, get the previous interview


*/

//Case 1:
if(is_home()||is_single()):
  $post=get_adjacent_post(false,'',true,'interview');
  if($post):
    setup_postdata($post);
    $teaser_image=get_field('teaser_image');
    $prev_image_url=$teaser_image['url'];
    $prev_url=get_permalink();
    wp_reset_postdata();
  else:
    $prev_image_url=get_template_directory_uri().'/assets/img/no-previous-teaser.jpg';
    $prev_url="#"; 
  endif; //previous interview

//Case 2:
else:
  $args = array( 'post_type' => 'interview', 'showposts' => 1);

  $loop = new WP_Query( $args ); ?>

  <?php if ($loop->have_posts()) : ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

      <?php $teaser_image=get_field('teaser_image');
            $prev_image_url=$teaser_image['url'];
            $prev_url=get_permalink();
      ?>
      
    <?php endwhile; ?>
  <?php else:
    $prev_image_url=get_template_directory_uri().'/assets/img/no-previous-teaser.jpg';
    $prev_url="#"; 
  endif; ?>

  <?php wp_reset_query(); ?>
<?php endif; //is home or single ?>

<?php

//NEXT INTERVIEW
$args = array( 'post_type' => 'interview', 'showposts' => 1, 'post__not_in' => $ids, 'post_status' => array('future') );

$loop = new WP_Query( $args ); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

  <?php $teaser_image=get_field('teaser_image');
        $next_image_url=$teaser_image['url'];
        // $next_url=get_permalink();
        $next_url="#";
  ?>
  
<?php endwhile; ?>

<?php wp_reset_query(); ?>


<div class="row-fluid" id="teasers">
  
    <div class="span4">
      <a href="<?php echo $prev_url; ?>">
      <h3>Past Interviews</h3>
      <div class="teaser-block">
        <img src="<?php echo $prev_image_url; ?>">
      </div>
      </a>
    </div>
  
  
    <div class="span4">
      <a href="<?php echo $next_url; ?>">
      <h3>Up Next Time</h3>
      <div class="teaser-block">
        <img src="<?php echo $next_image_url; ?>">
      </div>
      </a>
    </div>
  
  <div class="span4">
    <h3>Get Updates</h3>
    <div class="teaser-block">
      <div id="subscribe">
        <form action="http://womenandtech.us5.list-manage.com/subscribe/post?u=1370c4a70b43a1285e806a56d&amp;id=123c00728e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
              <!-- Begin MailChimp Signup Form -->
              <div class="mc-field-group">
                <label for="mce-EMAIL">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-email-symbol.png"></label>

                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" required>
              </div>
              <div id="placeholder">
                What's your email address?
              </div>
              <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </form>
        <!--End mc_embed_signup-->
      </div>
    </div>
</div>