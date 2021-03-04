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
                        'category_name' => 'css, html, javascript, web-designe' 
                    ]);

                    // Проверка постов
                    if( $myposts ){
                        // Если есть, запускаем цикл
                        foreach( $myposts as $post ){
                            setup_postdata( $post );
                            ?>
                                <!-- Выводим записи -->
                                <img src="<?the_post_thumbnail_url()?>" alt="<?the_title()?>" class="post-thumb">
                                <? $author_id = get_the_author_meta('ID') ?>
                                <a href="<? echo get_author_posts_url($author_id) ?>" class="author">
                                    <?php echo get_avatar( $author_id ); ?>
                                    <div class="author-bio">
                                        <span class="author-name"><? the_author() ?></span>
                                        <span class="author-rank">Разработчик</span>
                                    </div>
                                </a>
                                <div class="post-text">
                                    <? the_category() ?>
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
                            'category_name' => 'css, html, javascript, web-designe' 
                        ]);

                        // Проверка постов
                        if( $myposts ){
                            // Если есть, запускаем цикл
                            foreach( $myposts as $post ){
                                setup_postdata( $post );
                                ?>
                                    <!-- Выводим записи -->
                                    <li class="post">
                                        <? the_category() ?>
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
                'category_name' => 'articles'
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
                            <img width="65" height="65" src="<?echo get_the_post_thumbnail_url( null, 'thumbnail' )?>" alt="<?the_title()?>">
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

    <ul class="article-grid">
    <?php		
        global $post;

        $query = new WP_Query( [
            'posts_per_page' => 7,
            'tag' => 'popular'
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
                                    <p class="article-grid-excerpt"><? the_excerpt() ?></p>
                                    <div class="article-grid-info">
                                        <div class="author">
                                            <? $author_id = get_the_author_meta('ID') ?>
                                            <img src="<?php echo get_avatar_url( $author_id ); ?>" alt="<? the_author() ?>" class="author-avatar">
                                            <span class="author-name"><strong><? the_author() ?></strong>: <? the_author_meta('description') ?></span>
                                        </div>
                                        <div class="comments">
                                            <!-- <svg width="19" height="15" class="icon comments-icon">
                                                <use xlink:href=""></use>
                                            </svg> -->
                                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1346 10.9998V13.9998L8.36064 10.9998H2.25C1.42157 10.9998 0.75 10.3282 0.75 9.49976V1.99976C0.75 1.17133 1.42157 0.499756 2.25 0.499756H12.75C13.5784 0.499756 14.25 1.17133 14.25 1.99976V9.49976C14.25 10.3282 13.5784 10.9998 12.75 10.9998H11.1346Z" fill="#BCBFC2"/>
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
                                <img src="<?the_post_thumbnail_url()?>" alt="<? the_title() ?>" class="article-grid-thumb">
                                <a href="<? the_permalink() ?>" class="article-grid-permalink">
                                    <? $posttags = get_the_tags();
                                        if ( $posttags ) {
                                            ?><span class="tag"><?echo $posttags[0]->name . ' ';?></span><?
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
                                                <!-- <svg width="19" height="15" fill='#fff' class="icon comments-icon">
                                                    <use xlink:href=""></use>
                                                </svg> -->
                                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1346 10.9998V13.9998L8.36064 10.9998H2.25C1.42157 10.9998 0.75 10.3282 0.75 9.49976V1.99976C0.75 1.17133 1.42157 0.499756 2.25 0.499756H12.75C13.5784 0.499756 14.25 1.17133 14.25 1.99976V9.49976C14.25 10.3282 13.5784 10.9998 12.75 10.9998H11.1346Z" fill="#BCBFC2"/>
                                                </svg>
                                                <span class="comments-counter"><? comments_number( '0', '1', '%') ?></span>
                                            </div>
                                            <div class="likes">
                                                <img src="<? echo get_template_directory_uri() ?>/assets/images/heart.svg" alt="icon: like" class="likes-icon">
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
                                <img src="<?the_post_thumbnail_url()?>" alt="<? the_title() ?>" class="article-thumb">
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
</div>
<? get_footer(); ?>