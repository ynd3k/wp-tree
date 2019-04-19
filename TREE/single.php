<?php
    if ( in_category('news') ) {
        include(TEMPLATEPATH . '/single-news.php');
        get_template_part('single-news.php');
    } else if ( in_category('blog') ) {
        include(TEMPLATEPATH . '/single-blog.php');
    }else {//38行目閉じタグ
        if(basename($_SERVER['PHP_SELF']) === 'single.php'){
        include(TEMPLATEPATH . '/single.php');
        }
    
?>
    <?php get_header();?>
        <?php get_template_part('content', 'menu');?>

        <main class="l-main">
            <div class="p-section">
                <h1 class="p-section__title">未分類</h1>
            </div>
            <section class="l-news">
                <?php if(have_posts()):?>
                <?php while(have_posts()): the_post();?>
                    <span class="p-news__date"><?php the_time("Y年m月j日");?></span>
                    <h2 href="#" class="p-news__title"><?php the_title();?></h2>
                    <article class="p-news__article">
                        <?php the_content();?>
                    </article>
                <?php endwhile;?>
                <?php endif;?>
            </section>    

            <?php get_template_part('content', 'menu-bottom');?>    
        </main>

    <?php get_footer();?>
    <?php
    }


