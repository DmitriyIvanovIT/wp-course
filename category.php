<? get_header(); ?>
<div class="container">
    <h1 class="category-title">
        <?
            single_cat_title()
        ?>
    </h1>

    <div class="post-list">
        <?php while (have_posts()) {
            the_post(); ?>
            <div class="post-card">
                <?
                        if( has_post_thumbnail() ) {
                                                    
                            ?><img src="<?the_post_thumbnail_url()?>" alt="<? the_title() ?>" class="post-card-thumb">
                <?
                        }
                        else {
                            ?><img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<? the_title() ?>" class="post-card-thumb">
                <?
                        }
                    ?>
                <div class="post-card-text">
                    <h2 class="post-card-title">
                        <? echo mb_strimwidth(get_the_title(), 0, 20, '...') ?>
                    </h2>
                    <p>
                        <? echo mb_strimwidth(get_the_excerpt(), 0, 70, '...') ?>
                    </p>
                    <div class="author">
                        <? $author_id = get_the_author_meta('ID') ?>
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="<? the_author() ?>" class="author-avatar">
                        <div class="author-info">
                            <span class="author-name"><strong>
                                    <? the_author() ?>
                                </strong></span>
                            <span class="date">
                                <? the_time('j F') ?>
                            </span>
                            <div class="comments">
                                <svg width="19" height="15" fill='#fff' class="icon comments-icon">
                                    <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#comment"></use>
                                </svg>
                                <span class="comments-counter likes-counter">
                                    <? comments_number( '0', '1', '%') ?>
                                </span>
                            </div>
                            <div class="likes">
                                <svg width="19" height="15" class="icon likes-icon" fill='#BCBFC2'>
                                    <use xlink:href="<? echo get_template_directory_uri() ?>/assets/images/icons.svg#heart"></use>
                                </svg>
                                <span class="likes-counter">
                                    <? comments_number( '0', '1', '%') ?>
                                </span>
                            </div>
                        </div>
                        <!-- /.author-info -->
                    </div>
                </div>
                <!-- /.post-card-text -->
            </div>
        <?php } ?>
        <?php if (!have_posts()) { ?>
            Записей нет.
        <?php } ?>
    </div>

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
<? get_footer();