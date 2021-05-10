<section>
    <div id="pp_post__wrap">
        <div id="boxed__view">
            <!-- Post -->
            <div class="pp_post item">
                <!-- Header-contents -->
                <div class="pp_header">
                    <!-- Image -->
                    <div class="pp_left">
                        <?php echo the_post_thumbnail( 'medium' ); ?>
                    </div><!-- /Image -->
                    <!-- Title,short-desc,tech -->
                    <div class="pp_right">
                        <h2 class="pp_title">
                            <?php echo _e(the_title()); ?>
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
                        <?php echo the_content(); ?>
                    </p>
                </div><!-- /Long Desc -->
            </div> <!-- /Post -->
        </div>
    </div>
</section>