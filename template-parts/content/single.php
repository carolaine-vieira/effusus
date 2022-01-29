        <?php if (has_post_thumbnail()) : ?>
          <?php echo the_post_thumbnail(); ?>
        <?php endif; ?>        

        <div class="post-description">
          <h2 class="alt-font-style"><span><a href="<?php the_permalink(); ?>"> <?php the_title();?> </a></span></h2>
          <?php the_content(); ?>
        </div>
