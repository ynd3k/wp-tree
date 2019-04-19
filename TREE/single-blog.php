<!-- BLOG詳細ページ -->
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <div class="p-section">
            <h1 class="p-section__title u-fuwa">BLOG</h1>
        </div>
        <section class="l-news">
            <?php if(have_posts()):?>
            <?php while(have_posts()): the_post();?>
                <span class="p-news__date"><?php the_time("Y年m月j日");?></span>
                <h2 href="#" class="p-news__title"><?php the_title();?></h2>
                <?php //if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
                <article class="p-news__article">
                    <?php the_content();?>
                </article>
            <?php endwhile;?>
            <?php endif;?>
        </section>    

        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>