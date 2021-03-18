<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header <? echo get_post_type() ?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75)), url(
        <?
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail_url();
            } else {
                echo get_template_directory_uri().'/assets/images/not-photo.jpg';
            }
        ?>
    ); background-repeat: no-repeat; background-size: cover;">
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
                    <!-- Ссылка на главную -->
                    <a class="home-link" href="<? echo home_url( '/' ) ?>">
                        <svg width="18" height="17" class="icon comments-icon">
                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#home"></use>
                        </svg>
                        На главную
                    </a>
                    <?
                        the_post_navigation(
                            array(
                                'prev_text' => '<span class="post-nav-prev">
                                    <svg width="15" height="7" class="icon prev-icon" style="transform: rotate(180deg)">
                                        <use xlink:href="'. get_template_directory_uri() .'/assets/images/icons.svg#arrow"></use>
                                    </svg>
                                ' . esc_html__( 'Назад', 'universal-theme' ) . '</span>',
                                'next_text' => '<span class="post-nav-next">' . esc_html__( 'Вперед', 'universal-theme' ) . '
                                    <svg width="15" height="7" class="icon next-icon">
                                        <use xlink:href="'. get_template_directory_uri() .'/assets/images/icons.svg#arrow"></use>
                                    </svg>
                                </span>',
                            )
                        );
                    ?>
                </div>

                <div class="post-header-title-wrapper">
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="post-header-title">', '</h1>');
                    else :
                        the_title('<h2 class="post-header-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif;
                    ?>

                    <button class="bookmark">
                        <svg width="30" height="30" class="icon icon-bookmark">
                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#bookmark"></use>
                        </svg>
                    </button>
                </div>

                <p>
                    <? the_excerpt() ?>
                </p>

                <div class="post-header-info">
                    <span class="post-header-date">
                        <svg width="14" height="14" class="icon clock-icon">
                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#clock"></use>
                        </svg>
                        <? the_time('j F, H:i') ?>
                    </span>
                    <div class="likes post-header-likes">
                        <svg width="19" height="15" class="icon heart-icon">
                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#heart"></use>
                        </svg>
                        <span class="header-likes-counter">
                            <? comments_number( '0', '1', '%') ?>
                        </span>
                    </div>
                    <div class="comments post-header-comments">
                        <svg width="19" height="15" class="icon comment-icon">
                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#comment"></use>
                        </svg>
                        <span class="header-comments-counter">
                            <? comments_number( '0', '1', '%') ?>
                        </span>
                    </div>
                </div>

                <? $author_id = get_the_author_meta('ID') ?>
                <div class="post-author">
                    <div class="post-author-info">
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="" <? the_author() ?> class="post-author-avatar">
                        <span class="post-author-name">
                            <? the_author($author_id) ?>
                        </span>
                        <span class="post-author-rank">Должность</span>
                        <span class="post-author-posts">
                            <?
                                plural_form(
                                    count_user_posts($author_id),
                                    array('статья', 'статьи', 'статей')
                                )
                            ?>
                        </span>
                    </div>
                    <!-- /.post-author-info -->
                    <a href="<? echo get_author_posts_url($author_id) ?>" class="post-author-link">
                        Страница автора
                    </a>
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
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'universal-example'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('%1$s', 'universal-example') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
            ?>
        </footer>

        <?
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>
    </div>
</article>