<header class="l-header">
    <!-- スクロールで上固定メニュー -->
    <nav class="l-top__menu l-top__menu--fixed js-show-menu">
        <!-- pc用 -->
        <?php
        $defaults_top_fixed = array(
            'theme_location' => 'mainmenu',
            'container' => false,
            'items_wrap' => '<ul class="p-top-menu p-top-menu--fixed">%3$s</ul>'
        );
            wp_nav_menu($defaults_top_fixed);
        ?>
        
        <!-- <div class="p-top-menu-icon p-top-menu-icon--fixed">
            <?php //dynamic_sidebar('-SNSアイコン-エリア');?>
        </div> -->
        <div class="p-sp-menu js-click-sp-menu">
            <div class="p-sp-menu__line"></div>
            <div class="p-sp-menu__line"></div>
            <div class="p-sp-menu__line"></div>
        </div>
        <div class="p-sp-menu-right">
            <?php dynamic_sidebar('-TOP予約-エリア');?>
        </div>

        <div class="p-sp-menu-slide js-show-sp-menu u-d-none">
            <?php
            $defaults_sp_slide = array(
                'theme_location' => 'mainmenu',
                'container' => false,
                'items_wrap' => '%3$s'
            );
                wp_nav_menu($defaults_sp_slide);
            ?>
            <div class="p-sp-menu-slide__item">
                <?php dynamic_sidebar('-SNSアイコン-エリア');?>
            </div>
        </div>
    </nav>

    <div class="l-top l-common">
        <div class="l-top__logo">
            <a href="<?php bloginfo('url');?>" class="u-fuwa">
                <!-- トップロゴ画像 -->
                <?php if(get_header_image()):?>
                    <img class="p-top-logo" src="<?php header_image();?>" alt="トップロゴ画像">
                <?php else:?>   
                    <div class="p-top-logo__default">TREE</div>
                <?php endif;?>
                
            </a>
            <div class="p-top-info u-fuwa">
                <?php dynamic_sidebar('-TOP予約-エリア');?>
            </div>
        </div>
        <!-- トップページ画像   -->
        <?php if(home_url(). "/" == "http://". $_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"]):?>
        <?php //if($wp_query->is_home): ?>
        <div class="l-top__img" style="background-image: url(<?php show_img('home_top_img', HOME_TOP_IMG);?>); background-repeat: no-repeat; background-position: center; background-size: cover;">
            <div class="p-top-img-text">
                <div class="p-top-img-text__title u-fuwa"><?php echo get_post_meta($post->ID, 'home_top_img_text', true);?></div>
                <div class="p-top-img-text__subtitle u-fuwa"><span class="p-top-img-text__subtitle__text"><?php echo get_post_meta($post->ID, 'home_top_img_text_sub', true);?><span></div>
                <div class="u-fuwa"><a href="#top-main" class="p-top-img-text__link"><i class="p-top-img-text__scroll fas fa-angle-down"></i></a></div>
            </div>
            <?php query_posts('&posts_per_page=1&category_name=news'); ?>
            <?php if(have_posts()): while(have_posts()): the_post();?>
            <a href="<?php the_permalink();?>" class="p-news-tip p-news-latest js-hover-news">
                <span class="p-news-tip__category p-news-latest__item p-news-latest__category">お知らせ</span>
                <span class="p-news-tip__date p-news-latest__item p-news-latest__date"><?php the_time('Y/m/j');?></span>
                <div class="p-news-latest__item">
                    <span class="p-news-tip__title  p-news-latest__title"><?php the_title();?></span>
                    <i class="p-top-news__item__right p-news-latest__right fas fa-angle-double-right js-move-angle"></i>
                </div>
            </a>
            <?php endwhile;?>
            <?php endif;?>
            <?php wp_reset_query();?>
        </div>
        <?php endif;?>
        <!-- トップページ画像ここまで --> 
        <nav class="l-top__menu l-common__menu">
            <ul class="p-top-menu">
                <?php
                    wp_nav_menu($defaults_sp_slide);
                ?>
            </ul>
            <div class="p-top-menu-icon">
                <?php dynamic_sidebar('-SNSアイコン-エリア');?>
            </div>
        </nav>
    </div>
</header>