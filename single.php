<? get_header('post'); ?>
    <main class="site-main">
        <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );
            endwhile; // End of the loop.
        ?>
    </main>
<? get_footer();