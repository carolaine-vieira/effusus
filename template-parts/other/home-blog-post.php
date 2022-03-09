        <div
          class="blog-post"
          style="background-image: url('<?php echo the_post_thumbnail_url('full'); ?>');"
        >
          <div class="container">
            <div class="info">
              <h2><?php echo the_title(); ?></h2>
              <p>
              <?php echo the_excerpt(); ?>
              </p>
              <a href="<?php echo the_permalink(); ?>"><?php _e('View', 'effusus'); ?></a>
            </div>
          </div>
        </div>
       