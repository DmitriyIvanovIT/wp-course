<?php
/*
Template Name: home
Template Post Type: page
*/
?>
<? get_header(); ?>
<main class="front-page-header">
    <div class="container">
        <div class="hero">
            <div class="left">
                <?php
                    global $post;

                    $myposts = get_posts([ 
                        'numberposts' => 1,
                        'category_name' => 'css, html, javascript, web-design' 
                    ]);

                    // Проверка постов
                    if( $myposts ){
                        // Если есть, запускаем цикл
                        foreach( $myposts as $post ){
                            setup_postdata( $post );
                            ?>
                                <!-- Выводим записи -->
                                <?
                                    if( has_post_thumbnail() ) {
                                        ?> <img src="<?the_post_thumbnail_url()?>" alt="<?the_title()?>" class="post-thumb"> <?
                                    }
                                    else {
                                        ?> <img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<?the_title()?>" class="post-thumb"> <?
                                    }
                                ?>
                                
                                <? $author_id = get_the_author_meta('ID') ?>
                                <a href="<? echo get_author_posts_url($author_id) ?>" class="author">
                                    <?php echo get_avatar( $author_id ); ?>
                                    <div class="author-bio">
                                        <span class="author-name"><? the_author() ?></span>
                                        <span class="author-rank">Разработчик</span>
                                    </div>
                                </a>
                                <div class="post-text">
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
                                    <h2 class="post-title"><?echo mb_strimwidth(get_the_title(), 0, 50, '...')?></h2>
                                    <a href="<?echo get_the_permalink()?>" class="more">Читать далее</a>
                                </div>
                            <?php 
                        }
                    } else {
                        ?><p>
                            Постов нет
                        </p> <?
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                ?>
            </div>
            <!-- /.left -->
            <div class="right">
                <h3 class="recommend">Рекомендуем</h3>
                <ul class="posts-list">
                    <?php
                        global $post;

                        $myposts = get_posts([ 
                            'numberposts' => 5,
                            'offset' => 1,
                            'category_name' => 'css, html, javascript, web-design' 
                        ]);

                        // Проверка постов
                        if( $myposts ){
                            // Если есть, запускаем цикл
                            foreach( $myposts as $post ){
                                setup_postdata( $post );
                                ?>
                                    <!-- Выводим записи -->
                                    <li class="post">
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
                                        <a class="post-permalink" href="<?echo get_the_permalink()?>">
                                            <h4 class="post-title"><? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h4>
                                        </a>
                                    </li>
                                <?php 
                            }
                        } else {
                            ?><p>
                                Постов нет
                            </p> <?
                        }

                        wp_reset_postdata(); // Сбрасываем $post
                    ?>
                </ul>
            </div>
            <!-- /.right -->
        </div>
        <!-- /.hero -->
    </div>
    <!-- /.container -->
</main>

<div class="container">
    <ul class="article-list">
        <?php
            global $post;

            $myposts = get_posts([ 
                'numberposts' => 4,
                'category_name' => 'articles',
                'category__not_in' => array(24, 26, 25, 27, 28)
            ]);

            // Проверка постов
            if( $myposts ){
                // Если есть, запускаем цикл
                foreach( $myposts as $post ){
                    setup_postdata( $post );
                    ?>
                        <!-- Выводим записи -->
                        <li class="article-item">
                            <a class="article-permalink" href="<?echo get_the_permalink()?>">
                            <h4 class="article-title"><? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h4>
                            </a>
                            <img width="65" height="65" src="<?
                                if ( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail_url( null, 'thumbnail' );
                                } else {
                                    echo get_template_directory_uri().'/assets/images/not-photo.jpg';
                                }
                            ?>" alt="<?the_title()?>">
                        </li>
                    <?php 
                }
            } else {
                ?><p>
                    Постов нет
                </p> <?
            }

            wp_reset_postdata(); // Сбрасываем $post
        ?>
    </ul>
    <!-- ./article-list -->

    <div class="main-grid">
        <ul class="article-grid">
        <?php		
            global $post;

            $query = new WP_Query( [
                'posts_per_page' => 7,
                'tag' => 'popular',
                'category__not_in' => array(24, 26, 25, 27, 28)
            ] );

            if ( $query->have_posts() ) {
                // Счетчик постов
                $cnt = 0;
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $cnt++;
                    switch ($cnt) {
                        case '1':
                            ?>
                                <li class="article-grid-item article-grid-item-1">
                                    <a href="<? the_permalink() ?>" class="article-grid-permalink">
                                        <span class="category-name"><? $category = get_the_category(); echo $category[0]->name ?></span>
                                        <h4 class="article-grid-title"><? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h4>
                                        <p class="article-grid-excerpt"><? echo mb_strimwidth(get_the_excerpt(), 0, 110, '...') ?></p>
                                        <div class="article-grid-info">
                                            <div class="author">
                                                <? $author_id = get_the_author_meta('ID') ?>
                                                <img src="<?php echo get_avatar_url( $author_id ); ?>" alt="<? the_author() ?>" class="author-avatar">
                                                <span class="author-name"><strong><? the_author() ?></strong>: <? the_author_meta('description') ?></span>
                                            </div>
                                            <div class="comments">
                                                <svg width="19" height="15" class="icon comments-icon">
                                                    <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#comment"></use>
                                                </svg>
                                                <span class="comments-counter"><? comments_number( '0', '1', '%') ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?
                            break;
                        case '2':
                            ?>
                                <li class="article-grid-item article-grid-item-2">
                                    <?
                                        if( has_post_thumbnail() ) {
                                            ?><img src="<?the_post_thumbnail_url()?>" alt="<? the_title() ?>" class="article-grid-thumb"><?
                                        }
                                        else {
                                            ?><img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<? the_title() ?>" class="article-grid-thumb"><?
                                        }
                                    ?>
                                    <a href="<? the_permalink() ?>" class="article-grid-permalink">
                                        <? $posttags = get_the_tags();
                                            if ( $posttags ) {
                                                ?>
                                                    <div class="tags">
                                                        <?
                                                            foreach($posttags as $posttag) {
                                                                ?><span class="tag" style="margin-bottom: 10px;"><?echo $posttag->name . ' ';?></span><?
                                                            }
                                                        ?>
                                                    </div>
                                                <?
                                            }
                                        ?>
                                        
                                        <span class="category-name"><? $category = get_the_category(); echo $category[0]->name ?></span>
                                        <h4 class="article-grid-title"><? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h4>
                                        <div class="article-grid-info">
                                            <div class="author">
                                                <? $author_id = get_the_author_meta('ID') ?>
                                                <img src="<?php echo get_avatar_url( $author_id ); ?>" alt="<? the_author() ?>" class="author-avatar">
                                            <div class="author-info">
                                                <span class="author-name"><strong><? the_author() ?></strong></span>
                                                <span class="date"><? the_time('j F') ?></span>
                                                <div class="comments">
                                                    <svg width="19" height="15" fill='#fff' class="icon comments-icon">
                                                        <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#comment"></use>
                                                    </svg>
                                                    <span class="comments-counter likes-counter"><? comments_number( '0', '1', '%') ?></span>
                                                </div>
                                                <div class="likes">
                                                    <svg width="19" height="15" class="icon likes-icon" fill='#fff'>
                                                        <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#heart"></use>
                                                    </svg>
                                                    <span class="likes-counter"><? comments_number( '0', '1', '%') ?></span>
                                                </div>
                                            </div>
                                            <!-- /.author-info -->
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?
                            break;
                        case '3':
                            ?>
                            <li class="article-grid-item article-grid-item-3">
                                <a href="<? the_permalink() ?>" class="article-grid-permalink">
                                    <?
                                        if( has_post_thumbnail() ) {
                                            ?><img src="<?the_post_thumbnail_url()?>" alt="<? the_title() ?>" class="article-thumb"><?
                                        }
                                        else {
                                            ?><img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<? the_title() ?>" class="article-thumb"><?
                                        }
                                    ?>
                                    
                                    <h4 class="article-grid-title"><? echo mb_strimwidth(get_the_title(), 0, 40, '...') ?></h4>
                                </a>
                            </li>
                            <?
                            break;
                        default:
                            ?>
                                <li class="article-grid-item article-grid-item-default">
                                    <a href="<? the_permalink() ?>" class="article-grid-permalink">
                                        <h4 class="article-grid-title"><? echo mb_strimwidth(get_the_title(), 0, 20, '...') ?></h4>
                                        <p class="article-grid-excerpt"><? echo mb_strimwidth(get_the_excerpt(), 0, 110, '...') ?></p>
                                        <span class="article-date"><? the_time('j F') ?></span>
                                    </a>
                                </li>
                            <?
                            break;
                    }
                }
            } else {
                // Постов не найдено
            }

            wp_reset_postdata(); // Сбрасываем $post
        ?>
        </ul>
        <!-- /.article-grid -->

        <? get_sidebar('home-top') ?>
    </div>
</div>

<? 
        $myposts = get_posts([ 
            'numberposts' => 1,
            'category_name' => 'investigation' 
        ]); 
            // Проверка постов
            if( $myposts ){
                // Если есть, запускаем цикл
                foreach( $myposts as $post ){
                    setup_postdata( $post );
                    ?>
                    <section class="investigation" style="background: linear-gradient(0deg, rgba(64, 48, 61, 0.65), rgba(64, 48, 61, 0.65)), url(<?
                        if ( has_post_thumbnail() ) {
                            echo get_the_post_thumbnail_url();
                        } else {
                            echo get_template_directory_uri().'/assets/images/not-photo.jpg';
                        }
                    ?>) no-repeat center center">
                        <div class="container">
                            <h2 class="investigation-title"><? the_title() ?></h2>
                            <a href="<? the_permalink() ?>" class="more">Читать статью</a>
                        </div>
                    </section>
    <?php 
            }
        } else {
            ?><p>
                    Постов нет
            </p> <?
        }

        wp_reset_postdata(); // Сбрасываем $post
    ?>

<div class="container">
    <div class="favourites">
        <div class="digest-wrapper">
            <ul class="digest">
                <? 
                    $myposts = get_posts([ 
                        'numberposts' => 6,
                        'category_name' => 'news, opinions, hot, collections' 
                    ]); 
                        // Проверка постов
                        if( $myposts ){
                            // Если есть, запускаем цикл
                            foreach( $myposts as $post ){
                                setup_postdata( $post );
                                ?>
                                    <li class="digest-item">
                                        <a href="<? the_permalink() ?>" class="digest-item-permalink">
                                            <?
                                                if( has_post_thumbnail() ) {
                                                    
                                                    ?><img src="<?the_post_thumbnail_url()?>" alt="<? the_title() ?>" class="digest-thumb"><?
                                                }
                                                else {
                                                    ?><img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<? the_title() ?>" class="digest-thumb"><?
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
                                            <h3 class="digest-title"><? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h3>
                                            </a>
                                            <p class="digest-excerpt"><? echo mb_strimwidth(get_the_excerpt(), 0, 200, '...') ?></p>
                                            <div class="digest-footer">
                                            <span class="digest-date"><? the_time('j F') ?></span>
                                            <div class="comments digest-comments">
                                                <svg width="19" height="15" class="icon comments-icon">
                                                    <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#comment"></use>
                                                </svg>
                                                <span class="comments-counter"><? comments_number( '0', '1', '%') ?></span>
                                            </div>
                                            <div class="likes digest-likes">
                                                <svg width="19" height="15" class="icon likes-icon" fill="#BCBFC2">
                                                    <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#heart"></use>
                                                </svg>
                                                <span class="likes-counter"><? comments_number( '0', '1', '%') ?></span>
                                            </div>
                                            </div>
                                            <!-- /.digest-footer -->
                                        </div>
                                        <!-- /.digest-info -->
                                    </li>
                <?php 
                        }
                    } else {
                        ?><p>
                                Постов нет
                        </p> <?
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                ?>
                
            </ul>
        </div>
        
        <? get_sidebar('home-bottom') ?>
    </div>
</div>

<div class="special">
    <div class="container">
        <div class="special-grid">
        <div class="photo-report">
            <?php
                global $post;

                $myposts = get_posts([ 
                    'numberposts' => 1,
                    'category_name' => 'photo-report'
                ]);

                // Проверка постов
                if( $myposts ){
                    // Если есть, запускаем цикл
                    foreach( $myposts as $post ){
                        setup_postdata( $post );
                        ?>
                            <?
                                $media = get_attached_media( 'image' );

                                if ( $media ) {
                                    ?>
                                        <!-- Slider main container -->
                                        <div class="swiper-container photo-report-slider">
                                        <!-- Additional required wrapper -->
                                            <div class="swiper-wrapper">
                                                <!-- Slides -->
                                                <? foreach($media as $image) {
                                                    ?>
                                                        <div class="swiper-slide">
                                                            <img src="<? echo $image -> guid ?>">
                                                        </div>
                                                    <?
                                                } ?>
                                            </div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    <?
                                }
                            ?>
                            <div class="photo-report-content">
                                <?
                                    foreach(get_the_category() as $category) {
                                        printf(
                                            '<a href="%s" class="category-link">%s</a>', 
                                            get_category_link( $category ), 
                                            $category -> name
                                        );
                                    }
                                ?>
                                <? $author_id = get_the_author_meta('ID') ?>
                                <a href="<? echo get_author_posts_url($author_id) ?>" class="author">
                                    <img src="<? echo get_avatar_url($author_id) ?>" alt="<? the_author() ?>" class="author-avatar">
                                    <div class="author-bio">
                                        <span class="author-name"><? the_author() ?></span>
                                        <span class="author-rank">Разработчик</span>
                                    </div>
                                </a>
                                <h3 class="photo-report-title"><? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h3>
                                <a href="<? echo get_the_permalink() ?>" class="button photo-report-button">
                                    <svg width="19" height="15" class="icon photo-report-icon">
                                        <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#images"></use>
                                    </svg>
                                    Смотреть фото
                                    <span class="photo-report-counter"><? echo count($media) ?></span>
                                </a>
                            </div>
                            <!-- /.photo-report-content -->
                        <?php 
                    }
                } else {
                    ?><p>
                        Постов нет
                    </p> <?
                }

                wp_reset_postdata(); // Сбрасываем $post
            ?>
        </div>
        <!-- /.photo-report -->
        <div class="other">
            <div class="career-post">
                <?php
                    global $post;

                    $myposts = get_posts([ 
                        'numberposts' => 1,
                        'category_name' => 'career'
                    ]);

                    // Проверка постов
                    if( $myposts ){
                        // Если есть, запускаем цикл
                        foreach( $myposts as $post ){
                            setup_postdata( $post );
                            ?>  
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
                                <h3 class="career-post-title"><? echo mb_strimwidth(get_the_title(), 0, 50, '...') ?></h3>
                                <p class="career-post-excerpt">
                                    <? echo mb_strimwidth(get_the_excerpt(), 0, 100, '...') ?>
                                </p>
                                <a href="<? echo get_the_permalink() ?>" class="more">Читать далее</a>
                            <?php 
                        }
                    } else {
                        ?><p>
                            Постов нет
                        </p> <?
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                ?>
            </div>
            <!-- /.career-post -->
            <div class="other-posts">
                <?php
                    global $post;

                    $myposts = get_posts([ 
                        'numberposts' => 2,
                        'category_name' => 'other'
                    ]);

                    // Проверка постов
                    if( $myposts ){
                        // Если есть, запускаем цикл
                        foreach( $myposts as $post ){
                            setup_postdata( $post );
                            ?>  
                                <a href="<? the_permalink() ?>" class="other-post other-post-default">
                                    <h4 class="other-post-title"><? echo mb_strimwidth(get_the_title(), 0, 20, '...') ?></h4>
                                    <p class="other-post-excerpt"><? echo mb_strimwidth(get_the_excerpt(), 0, 110, '...') ?></p>
                                    <span class="other-post-date"><? the_time('j F') ?></span>
                                </a>
                            <?php 
                        }
                    } else {
                        ?><p>
                            Постов нет
                        </p> <?
                    }

                    wp_reset_postdata(); // Сбрасываем $post
                ?>
            </div>
            <!-- /.other-posts -->
        </div>
        <!-- /.other -->
        </div>
        <!-- /.special-grid -->
    </div>
    <!-- /.container -->
</div>
<!-- /.special -->

<? get_footer();