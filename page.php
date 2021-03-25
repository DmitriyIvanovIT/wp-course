<? get_header(); ?>
    <main class="site-main">
        <div class="container">
            <div class="post-content">
                <h1><? the_title() ?></h1>
                <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'universal-example'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post(get_the_title())
                    )
                );
                ?>
            </div>
        </div>
    </main>
<?
    get_footer();