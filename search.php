<? get_header(); ?>
<div class="container">
    <h1 class="search-title">Результаты поиска по запросу:</h1>
    <div class="favourites">
        <div class="digest-wrapper">
            <ul class="digest">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <li class="digest-item">
                            <a href="<? the_permalink() ?>" class="digest-item-permalink">
                                <?
                                if( has_post_thumbnail() ) {
                                                
                                    ?><img src="<?the_post_thumbnail_url()?>" alt="<? the_title() ?>" class="digest-thumb">
                                <?
                                }
                                else {
                                    ?><img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<? the_title() ?>" class="digest-thumb">
                                <?
                                }
                            ?>
                            </a>
                            <div class="digest-info">
                                <button class="bookmark">
                                    <svg width="14" height="18" class="icon icon-bookmark">
                                        <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#bookmark"></use>
                                    </svg>

                                </button>
                                <?
                                foreach(get_the_category() as $category) {
                                    printf(
                                        '<a href="%s" class="category-link %s">%s</a>', 
                                        get_category_link( $category ), 
                                        $category -> slug,
                                        $category -> name
                                    );
                                }
                            ?>
                                <a href="#" class="digest-item-permalink">
                                    <h3 class="digest-title">
                                        <? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?>
                                    </h3>
                                </a>
                                <p class="digest-excerpt">
                                    <? echo mb_strimwidth(get_the_excerpt(), 0, 200, '...') ?>
                                </p>
                                <div class="digest-footer">
                                    <span class="digest-date">
                                        <? the_time('j F') ?>
                                    </span>
                                    <div class="comments digest-comments">
                                        <svg width="19" height="15" class="icon comments-icon">
                                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#comment"></use>
                                        </svg>
                                        <span class="comments-counter">
                                            <? comments_number( '0', '1', '%') ?>
                                        </span>
                                    </div>
                                    <div class="likes digest-likes">
                                        <svg width="19" height="15" class="icon likes-icon" fill="#BCBFC2">
                                            <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#heart"></use>
                                        </svg>
                                        <span class="likes-counter">
                                            <? comments_number( '0', '1', '%') ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- /.digest-footer -->
                            </div>
                            <!-- /.digest-info -->
                        </li>
                    <?php endwhile;
                else : ?>
                    Записей нет.
                <?php endif; ?>
            </ul>

            <? 
            $args = array(
                'prev_text' => '
                    &larr;  Назад
                ',
                'next_text' => '
                    Вперед &rarr;
                ',
            );
            the_posts_pagination( $args ); 
            
            ?>
        </div>

        <? get_sidebar('home-bottom') ?>
    </div>
</div>
<? get_footer();