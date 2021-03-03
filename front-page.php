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
</div>
<? get_footer(); ?>