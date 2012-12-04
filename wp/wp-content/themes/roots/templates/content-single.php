<?php 
global $custom_content;
  while (have_posts()): the_post(); ?>
    
    <article class="<?php echo implode(get_post_class(), " ")." "; echo get_field('custom_css_class'); ?>" id="post-<?php the_ID(); ?>">
      <?php if (!$custom_content): ?>
        <header class="container">
          <div class="row">
            <div class="span9">
              <?php get_template_part('templates/page', 'header'); ?>
            </div>
          </div>
        </header>
        <div class="container">
          <div class="row">
            <div class="span12">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
        <?php else:
          get_template_part("custom-content/$custom_content");
      endif; ?>
    </article>
<?php endwhile; ?>