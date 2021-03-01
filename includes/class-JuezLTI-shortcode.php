<?php

class JuezLTI_shortcode
{

    public function JuezLTI_shortcode_init()
    {
        function JuezLTI_shortcode($atts, $content = null)
        {

            $atts = shortcode_atts( array(
                'n_elementos' => get_option('JuezLTI_options_nElementos'),
            ), $atts );

            $query = new WP_Query( array( 'post_type' => 'commit' , 'commits_per_page' => $atts['n_elementos']) );

            ob_start();
  
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                    <?php $urlCommit = get_post_meta(get_the_ID(), 'url', true)?>

                    <div>
                        <h2><a href="<?php echo $urlCommit?>" target="_blank"><?php the_title(); ?></a></h2>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>
<?php
            $content = ob_get_contents ();
            ob_end_clean();
            return $content;
        }
        add_shortcode('JuezLTI', 'JuezLTI_shortcode');
    }

}