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
                                    <h2 class="post-title"><?the_title()?></h2>
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
                            'offset' => 1
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
                                            <h4 class="post-title"><?the_title()?></h4>
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
<? get_footer(); ?>