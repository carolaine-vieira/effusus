          <div
            class="slide active"
            style="background-image: url('<?php the_post_thumbnail_url(); ?>')"
          >
            <div class="container">
              <div class="info">
                <h2>
                  <?php the_title(); ?>
                </h2>
                <a href="<?php the_field('slide_one_link'); ?>"><?php the_field('slide_one_link_label'); ?></a>
              </div>
            </div>
          </div>