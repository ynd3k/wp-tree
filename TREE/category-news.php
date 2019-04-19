<!-- NEWS一覧ページ -->
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <div class="p-section">
            <h1 class="p-section__title u-fuwa">NEWS</h1>
        </div>
        <section class="l-news-list">
            <?php if(have_posts()):?>
            <?php while(have_posts()): the_post();?>
                <a href="<?php the_permalink();?>" class="c-text__body p-top-news__item">
                    <div class="p-news-tip">
                        <span class="p-news-tip__category p-news-tip__item">お知らせ</span>
                        <span class="p-news-tip__date p-news-tip__item"><?php the_time("Y年m月j日");?></span>
                        <span class="p-news-tip__title p-news-tip__item"><?php the_title();?></span>
                    </div>
                    <i class="p-top-news__item__right fas fa-angle-double-right"></i>
                </a>
                <!-- スマホ表示用 -->
                <a href="<?php the_permalink();?>" class="c-text__body p-top-news__item p-news-tip-sp">
                    <div>
                        <span class="p-news-tip__category p-news-tip__item">お知らせ</span>
                        <span class="p-news-tip__date p-news-tip__item"><?php the_time("Y年m月j日");?></span>
                    </div>
                    <div class="p-news-tip-sp__title-wrapper">
                        <span class="p-news-tip__title p-news-tip__item"><?php the_title();?></span>
                        <i class="p-top-news__item__right p-news-tip-sp__right fas fa-angle-double-right"></i>
                    </div>
                </a>
            <?php endwhile;?>
            <?php endif;?>
            
        </section>    
        <section class="l-pagination">
            <?php if(function_exists("pagination")) pagination($wp_query->max_num_pages);?>
        </section>
        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>