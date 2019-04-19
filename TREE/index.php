<?php
/*
Template Name: HOME(トップページ)
*/
?>
<?php get_header();?>
        <?php get_template_part('content', 'menu');?>

        <main class="l-main">
            <a id="top-main"></a>
            <div class="p-top-about u-fuwa">
                <img class="p-top-about__img" src="<?php show_img('home_about_img', HOME_ABOUT_IMG);?>" alt="ABOUT画像">
                <div class="c-text p-top-about__text">
                    <h2 class="c-text__title">ABOUT TREE</h2>
                    <p class="c-text__body">
                        <?php echo get_post_meta($post->ID, 'home_about_msg', true);?>
                    </p>
                    <a href="<?php getPageUrl('home_about_url', 'about', $post->ID);?>" class="c-btn p-top-about__text__btn">
                        MORE
                        <!-- <i class="c-btn__angle fas fa-angle-double-right"></i> -->
                        <!-- <i class="c-btn__angle fas fa-long-arrow-alt-right"></i> -->
                    </a>
                </div>
            </div>
            <div class="p-top-staff u-fuwa">
                <div class="c-text">
                    <h2 class="c-text__title">STAFF</h2>
                    <p class="c-text__body">
                        <?php echo get_post_meta($post->ID, 'home_staff_msg', true);?>
                    </p>
                </div> 
                <div class="p-top-staff__list">
                    <ul class="l-card-grid">
                        <?php for($i=1; $i<=4; $i++):?>
                        <li class="c-card u-fuwa">
                            <a href="<?php 
                                if(get_post_meta($post->ID, 'home_staff_url'. $i, true)){
                                    echo get_post_meta($post->ID, 'home_staff_url'. $i, true);
                                }else{
                                    echo home_url(). '/staff-'. $i;
                                }
                            ?>">
                            <div class="c-card__img-wrapper">
                                <img class="c-card__img-wrapper__img" src="<?php show_img('home_staff_img'.$i, STAFF_IMG[$i]);?>" alt="スタッフの写真">
                                <div class="c-card__img-wrapper__cover">
                                    <div class="c-card__img-wrapper__cover__text">Profile & Schedule</div>
                                    <i class="c-card__img-wrapper__cover__angle fas fa-angle-double-right"></i>
                                </div>
                            </div>
                            <div class="c-card__name--sub"><?php echo get_post_meta($post->ID, 'home_staff_name'.$i.'_romaji', true);?></div>
                            <div class="c-card__name"><?php echo get_post_meta($post->ID, 'home_staff_name'.$i.'_kanji', true);?></div>
                            </a>
                        </li>
                        <?php endfor;?>
                    </ul>
                </div> 
                <a href="<?php getPageUrl('home_staff_list_url', 'staff-list', $post->ID);?>" class="c-btn p-top-staff__btn u-fuwa">
                    MORE
                    <!-- <i class="c-btn__angle fas fa-angle-double-right"></i> -->
                </a>
            </div>
            <div class="p-top-news u-fuwa">
                <div class="c-text">
                    <h2 class="c-text__title">BLOG</h2>
                    <?php query_posts('&posts_per_page=2&category_name=blog'); ?>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <a href="<?php the_permalink();?>" class="c-text__body p-top-news__item">
                            <div class="p-news-tip">
                                <span class="p-news-tip__category p-news-tip__item">
                                    <?php $cat = get_the_category(); ?>
                                    <?php $cat = $cat[0]; ?>
                                    <?php echo get_cat_name($cat->term_id); ?>
                                </span>
                                <span class="p-news-tip__date p-news-tip__item"><?php the_time('Y/m/d');?></span>
                                <span class="p-news-tip__title p-news-tip__item"><?php the_title();?></span>
                            </div>
                            <i class="p-top-news__item__right fas fa-angle-double-right"></i>
                        </a>
                        <!-- スマホ表示用 -->
                        <a href="<?php the_permalink();?>" class="c-text__body p-top-news__item p-news-tip-sp">
                            <div>
                                <span class="p-news-tip__category p-news-tip__item">
                                    <?php $cat = get_the_category(); ?>
                                    <?php $cat = $cat[0]; ?>
                                    <?php echo get_cat_name($cat->term_id); ?>
                                </span>
                                <span class="p-news-tip__date p-news-tip__item"><?php the_time('Y/m/d');?></span>
                            </div>
                            <div class="p-news-tip-sp__title-wrapper">
                                <span class="p-news-tip__title p-news-tip__item"><?php the_title();?></span>
                                <i class="p-top-news__item__right p-news-tip-sp__right fas fa-angle-double-right"></i>
                            </div>
                        </a>
                    <?php endwhile;?>
                    <?php endif; ?>
                    <?php wp_reset_query();?>
                </div>
                <a href="<?php getPageUrl('home_blog_list_url', 'category/blog', $post->ID);?>" class="c-btn p-top-news__btn">MORE</a>
            </div>

            <div class="p-top-news u-fuwa">
                <div class="c-text">
                    <h2 class="c-text__title">NEWS</h2>
                    <?php query_posts('&posts_per_page=2&category_name=news'); ?>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <a href="<?php the_permalink();?>" class="c-text__body p-top-news__item">
                            <div class="p-news-tip">
                                <span class="p-news-tip__category p-news-tip__item">お知らせ</span>
                                <span class="p-news-tip__date p-news-tip__item"><?php the_time('Y/m/d');?></span>
                                <span class="p-news-tip__title p-news-tip__item"><?php the_title();?></span>
                            </div>
                            <i class="p-top-news__item__right fas fa-angle-double-right"></i>
                        </a>
                        <!-- スマホ表示用 -->
                        <a href="<?php the_permalink();?>" class="c-text__body p-top-news__item p-news-tip-sp">
                            <div>
                                <span class="p-news-tip__category p-news-tip__item">お知らせ</span>
                                <span class="p-news-tip__date p-news-tip__item"><?php the_time('Y/m/d');?></span>
                            </div>
                            <div class="p-news-tip-sp__title-wrapper">
                                <span class="p-news-tip__title p-news-tip__item"><?php the_title();?></span>
                                <i class="p-top-news__item__right p-news-tip-sp__right fas fa-angle-double-right"></i>
                            </div>
                        </a>
                    <?php endwhile;?>
                    <?php endif; ?>
                    <?php wp_reset_query();?>
                </div>
                <a href="<?php getPageUrl('home_news_list_url', 'category/news', $post->ID);?>" class="c-btn p-top-news__btn">MORE</a>
            </div>
            <?php get_template_part('content', 'menu-bottom');?>
        </main>

        <?php get_footer();?>