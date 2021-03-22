<? get_header('post'); ?>
<main class="site-main">
    <?php
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content', get_post_type());

            $category = get_the_category()[0] -> slug;
            $id_post = get_the_ID();

            // параметры по умолчанию
            $posts = get_posts( array(
                'numberposts' => 4,
                'category_name'    => $category,
                'exclude'     => $id_post,
            ) );

            if ($posts) {
                ?>
                    <div class="other-posts single-other-posts">
                        <div class="container">
                            <div class="other-posts-wrapper">
                                <?
                                    foreach( $posts as $post ){
                                        setup_postdata($post);
                                        ?>
                                            <div class="other-posts-card">
                                            <?
                                                if( has_post_thumbnail() ) {
                                                    ?> <img src="<?the_post_thumbnail_url()?>" alt="<?the_title()?>" class="other-posts-card__img"> <?
                                                }
                                                else {
                                                    ?> <img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<?the_title()?>" class="other-posts-card__img"> <?
                                                }
                                            ?>
                                                <a href="<?echo get_the_permalink()?>"  class="other-posts-card__title">
                                                    <?echo mb_strimwidth(get_the_title(), 0, 50, '...')?>
                                                </a>
                                                <div class="other-posts-card__footer">
                                                    <div class="other-posts-card__watch">
                                                        <svg width="15" height="15" class="icon whatch-icon" fill="#BCBFC2">
                                                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#eye"></use>
                                                        </svg>
                                                        <span class="whatch-counter"><? comments_number( '0', '1', '%') ?></span>
                                                    </div>
                                                    <div class="other-posts-card__comments">
                                                        <svg width="15" height="15" class="icon comments-icon">
                                                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#comment"></use>
                                                        </svg>
                                                        <span class="comments-counter"><? comments_number( '0', '1', '%') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                    }
                                ?>
                            </div>
                            
                        </div>
                    </div>
                <?
                
    
                wp_reset_postdata(); // сброс
            }
            ?>
                <div class="container">
                    <?
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    ?>
                </div>
            <?
        endwhile; // End of the loop.
    ?>
</main>
<? get_footer();