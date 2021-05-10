<section>
    <div id="pp_post__wrap">
        <div id="boxed__view">
            <!-- Post -->
            <div class="pp_post pparchive">
                <!-- Header-contents -->
                <div class="pp_header">
                    <!-- Image -->
                    <div class="pp_left">
                        <a href="<?php echo esc_url(get_the_permalink()) ?>">
                        <?php echo the_post_thumbnail( 'medium' ); ?>
                        </a>
                    </div><!-- /Image -->
                    <!-- Title,short-desc,tech -->
                    <div class="pp_right">
                        <h2 class="pp_title">
                            <a href="<?php echo esc_url(get_the_permalink()) ?>">
                            <?php echo _e(get_the_title()); ?>
                            </a>
                        </h2>
                        <p class="pp_short_desc">
                            <?php echo _e(get_the_excerpt(  )) ?>
                        </p>
                        <div class="pp_technologies">
                            <?php  the_terms( get_post(), 'technologies', 'Technologies: ', ', ', ' ' ) ?>
                        </div>
                    </div><!-- /Title,short-desc,tech -->
                </div>
                <!-- Long Desc -->
                <div class="pp_body">
                    <p class="pp_long_desc">
                        <?php echo _e(get_the_content()) ?>
                    </p>
                </div><!-- /Long Desc -->
                <!-- Post-Info -->
                <div class="pp_footer">
                    Published:&nbsp;
                    <span class="pp_created_date"><?php echo _e(get_the_date( 'M-d-y')) ?></span>
                </div><!-- /Post-Info -->
            </div> <!-- /Post -->
        </div>
    </div>
</section>