<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header <? echo get_post_type() ?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75));">
        <div class="container">
            <div class="post-header-wrapper">
                <div class="post-header-nav">
                    <?
                        foreach(get_the_category() as $category) {
                            printf(
                                '<a href="%s" class="category-link %s">%s</a>', 
                                esc_url(get_category_link( $category )), 
                                esc_html($category -> slug),
                                esc_html($category -> name)
                            );
                        }
                    ?>
                </div>

                <div class="video">
                    <?
                        $video_link = get_field('video_link');

                        if(strpos($video_link, 'youtube') !== false) {
                            $tmp = explode('?v=', $video_link);
                            ?>
                                <iframe width="100%" height="450" src="https://www.youtube.com/embed/<?echo end ($tmp);?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <?
                            
                        } elseif (strpos($video_link, 'vimeo')) {
                            $tmp = explode('https://vimeo.com/', $video_link);
                            ?>
                                <iframe src="https://player.vimeo.com/video/<?echo end ($tmp);?>" width="100%" height="450" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                            <?
                        }
                        
                    ?>
                </div>

                <div class="lesson-header-title-wrapper">
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="lesson-header-title">', '</h1>');
                    else :
                        the_title('<h2 class="lesson-header-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif;
                    ?>
                </div>

                <div class="post-header-info">
                    <span class="post-header-date">
                        <svg width="14" height="14" class="icon clock-icon">
                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#clock"></use>
                        </svg>
                        <? the_time('j F, H:i') ?>
                    </span>
                </div>
            </div>
        </div>


    </header><!-- .entry-header -->

    <div class="container">
        <div class="post-content">
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

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'universal-example'),
                        'after'  => '</div>',
                    )
                );
            ?>
        </div>
        <footer class="entry-footer">
            <?php
                $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'universal-example'));
                if ($tags_list) {
                    /* translators: 1: list of tags. */
                    printf('<span class="tags-links">' . esc_html__('%1$s', 'universal-example') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }

                meks_ess_share();
            ?>
        </footer>
    </div>
</article>