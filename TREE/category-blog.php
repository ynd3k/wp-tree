<!-- BLOG一覧ページ -->
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <div class="p-section">
            <h1 class="p-section__title u-fuwa">BLOG</h1>
        </div>
        <section class="l-blog-list">
            <?php if(have_posts()):?>
            <?php while(have_posts()): the_post();?>
                <article class="c-blog-card u-fuwa">
                    <a href="<?php the_permalink();?>" class="c-blog-card__a">
                        <?php 
                        if(has_post_thumbnail()){
                            the_post_thumbnail();
                        }elseif(is_active_sidebar('widget_blog_no_img')){
                            dynamic_sidebar('-BLOG一覧ー-エリア');
                        }
                        else{
                        ?>
                            <img src="<?php echo get_template_directory_uri(). '/src/images/'. NO_IMG;?>" alt="NO=IMAGE">
                        <?php
                        }
                        ?>
                        <h3 class="c-blog-card__date"><?php the_time("Y年m月j日");?></h3>
                        <h2 class="c-blog-card__title"><?php the_title();?></h2>    
                    </a>            
                </article>
            <?php endwhile;?>
            <?php endif;?>

        </section>    
        <section class="l-pagination">
            <?php if(function_exists("pagination")) pagination($wp_query->max_num_pages);?>
        </section>
        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>