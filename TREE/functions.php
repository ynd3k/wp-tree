<?php
define('HOME_TOP_IMG', 'top.jpg');
define('HOME_ABOUT_IMG', 'top_about.jpg');
define('STAFF_IMG', ['', 'staff_1.jpg', 'staff_2.jpg', 'staff_3.jpg', 'staff_4.jpg', 'staff_5.jpg']);
define('ABOUT_CONCEPT_IMG', ['concept_1.jpg', 'concept_2.jpg', 'concept_3.jpg', 'concept_4.jpg']);
define('STAFF_LIST_IMG', 'staff_top.jpg');
define('MENU_IMG', 'menu_top.jpg');
define('NO_IMG', 'noimg.png');

//カスタムフィールドの画像 単体
function show_img($key, $name){
    global $post;
    if(get_post_meta($post->ID, $key, true)){
        echo get_post_meta($post->ID, $key, true);
    }
    else{
        echo get_template_directory_uri(). '/src/images/'. $name;
    }
}
//カスタムフィールドの画像　複数 staff
function show_img_costom($key, $name){
    $url = "http://". $_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"];
    $posi = strpos($url, 'staff-');
    if($posi !== false){
        $img_index = substr($url, $posi + 6, 1);
    }
    global $post;
    if(get_post_meta($post->ID, $key, true)){
        echo get_post_meta($post->ID, $key, true);
    }
    else{
        echo get_template_directory_uri(). '/src/images/'. $name[$img_index];
    } 
}
function show_img_widget($img, $title){
    if($img){
        echo $img;
        return;
    }
    if($title == 'CAFE SPACE'){
        echo get_template_directory_uri(). '/src/images/'. ABOUT_CONCEPT_IMG[0];
    }
    elseif($title == 'OIL MASSAGE'){
        echo get_template_directory_uri(). '/src/images/'. ABOUT_CONCEPT_IMG[1];
    }
    elseif($title == 'CARBONATE SPRING'){
        echo get_template_directory_uri(). '/src/images/'. ABOUT_CONCEPT_IMG[2];
    }
    elseif($title == 'NANO STEAMER'){
        echo get_template_directory_uri(). '/src/images/'. ABOUT_CONCEPT_IMG[3];
    }

    if($title == 'Kyoko Washimi'){
        echo get_template_directory_uri(). '/src/images/'. STAFF_IMG[1];
    }
    elseif($title == 'Masato Kanno'){
        echo get_template_directory_uri(). '/src/images/'. STAFF_IMG[2];
    }
    elseif($title == 'Taiki Furusawa'){
        echo get_template_directory_uri(). '/src/images/'. STAFF_IMG[3];
    }
    elseif($title == 'Yui Okano'){
        echo get_template_directory_uri(). '/src/images/'. STAFF_IMG[4];
    }
    elseif($title == 'Mayumi Ueda'){
        echo get_template_directory_uri(). '/src/images/'. STAFF_IMG[5];
    }
}

function getPageUrl($key, $page, $post_id){
    if(get_post_meta($post_id, $key, true)){
        echo get_post_meta($post_id, $key, true);
    }else{
        echo home_url(). '/'. $page;
    }
}

//カスタムヘッダー画像
$custom_header_defaults = array(
    'default-image' => '',
    'width' => 100,
    'height' => 100,
);
add_theme_support('custom-header', $custom_header_defaults);

//投稿サムネイル有効化
add_theme_support( 'post-thumbnails' ); 

//カスタムメニュー
register_nav_menu('mainmenu', 'メインメニュー');

//ページネーション
function pagination($pages = '', $range = 2){
    $showitems = ($range * 2) + 1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) $pages = 1;
    }
    if(1 != $pages){
        echo '<ul class="p-pagination">';
        if($paged > 1) echo '<a class="p-pagination__prev" href="'. get_pagenum_link($paged - 1). '">PREV</a>';
        for($i = 1; $i <= $pages; $i++){
            if(1 != $pages &&( !($i >= $paged * $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems) ){
                echo ($paged == $i) ? '<li class="p-pagination__item p-pagination__item--active">'. $i. '</li>' : '<li class="p-pagination__item"><a href="'. get_pagenum_link($i). '">'. $i. '</a></li>';
            }
        }
        if($paged < $pages) echo '<a class="p-pagination__next" href="'. get_pagenum_link($paged + 1). '">NEXT</a>';
        echo '</ul>';
    }
}

//カスタムフィールド
add_action('admin_menu', 'add_custom_inputbox');
add_action('save_post', 'save_custom_postdata');

function add_custom_inputbox(){
    add_meta_box('home_about_id', '-HOME-  入力欄', 'custom_area', 'page', 'normal');
    add_meta_box('about_id', '-ABOUT- 入力欄', 'custom_area2', 'page', 'normal');
    add_meta_box('staff_list_id', '-STAFF一覧- 入力欄', 'custom_area3', 'page', 'normal');
    add_meta_box('staff_id', '-STAFF- 入力欄', 'custom_area4', 'page', 'normal');
    add_meta_box('menu_id', '-MENU- 入力欄', 'custom_area5', 'page', 'normal');
    add_meta_box('reserved_id', '-RESERVED- 入力欄', 'custom_area6', 'page', 'normal');
}

function custom_area(){
    global $post;
    echo 'トップ画像<br><input value="'. get_post_meta($post->ID, 'home_top_img', true).'" name="home_top_img"><br>';
    echo 'トップ画像テキスト<br><input value="'. get_post_meta($post->ID, 'home_top_img_text', true).'" name="home_top_img_text"><br>';
    echo 'トップ画像サブテキスト<br><input value="'. get_post_meta($post->ID, 'home_top_img_text_sub', true).'" name="home_top_img_text_sub"><br>';
    echo 'ABOUT説明欄<br><textarea cols="50" rows="5" name="home_about_msg">'. get_post_meta($post->ID, 'home_about_msg', true). '</textarea><br>';
    echo 'ABOUT画像URL<br><input value="'. get_post_meta($post->ID, 'home_about_img', true).'" name="home_about_img"><br>';
    echo 'STAFF説明欄<br><textarea cols="50" rows="5" name="home_staff_msg">'. get_post_meta($post->ID, 'home_staff_msg', true). '</textarea><br>';
    for($i=1; $i<=4; $i++){
        echo 'スタッフ名'. $i. '(ローマ字) <input value="'.get_post_meta($post->ID, 'home_staff_name'. $i. '_romaji', true). '" name="home_staff_name'. $i. '_romaji"></input><br>';
        echo 'スタッフ名'. $i. '(漢字) <input value="'.get_post_meta($post->ID, 'home_staff_name'. $i. '_kanji', true). '" name="home_staff_name'. $i. '_kanji"></input><br>';
        echo 'スタッフ名'. $i. '(画像) <input value="'.get_post_meta($post->ID, 'home_staff_img'. $i, true). '" name="home_staff_img'. $i. '"></input><br>';
        echo 'スタッフ名'. $i. '(スタッフ詳細URL) <input value="'.get_post_meta($post->ID, 'home_staff_url'. $i, true). '" name="home_staff_url'. $i. '"></input><br><br>';
    }
    echo 'ABOUTのリンク(MOREボタン)<br><input value="'. get_post_meta($post->ID, 'home_about_url', true).'" name="home_about_url"><br>';
    echo 'STAFF一覧のリンク(MOREボタン)<br><input value="'. get_post_meta($post->ID, 'home_staff_list_url', true).'" name="home_staff_list_url"><br>';
    echo 'BLOG一覧のリンク(MOREボタン)<br><input value="'. get_post_meta($post->ID, 'home_blog_list_url', true).'" name="home_blog_list_url"><br>';
    echo 'NEWS一覧のリンク(MOREボタン)<br><input value="'. get_post_meta($post->ID, 'home_news_list_url', true).'" name="home_news_list_url"><br>';
}
function custom_area2(){
    global $post;
    echo 'トップ画像<br><input value="'. get_post_meta($post->ID, 'about_top_img', true).'" name="about_top_img"><br>';
    echo 'CONCEPT入力欄<br><textarea cols="50" rows="5" name="about_concept_msg">'. get_post_meta($post->ID, 'about_concept_msg', true). '</textarea><br>';
    echo 'GoogleMap入力欄<br><textarea cols="50" rows="5" name="map">'. get_post_meta($post->ID, 'map', true). '</textarea><br>';
}
function custom_area3(){
    global $post;
    echo 'トップ画像<br><input value="'. get_post_meta($post->ID, 'staff_list_top_img', true).'" name="staff_list_top_img"><br>';
    echo 'OUR TEAM入力欄<br><textarea cols="50" rows="5" name="staff_list_msg">'. get_post_meta($post->ID, 'staff_list_msg', true). '</textarea><br>';
}
function custom_area4(){
    global $post;
    echo 'スタッフ画像<br><input value="'. get_post_meta($post->ID, 'staff_img', true).'" name="staff_img"><br>';
    echo 'スタッフ名(ローマ字)<br><input value="'. get_post_meta($post->ID, 'staff_romaji', true).'" name="staff_romaji"><br>';
    echo 'スタッフ名(漢字)<br><input value="'. get_post_meta($post->ID, 'staff_kanji', true).'" name="staff_kanji"><br>';
    echo 'スタッフコメント<br><textarea cols="50" rows="5" name="staff_msg">'. get_post_meta($post->ID, 'staff_msg', true). '</textarea><br>';
    for($i=1; $i<=7; $i++){
        echo '出勤スケジュール'. $i. '<br><input value="'. get_post_meta($post->ID, 'staff_schedule'. $i, true).'" name="staff_schedule'. $i. '"><br>';
    }
}
function custom_area5(){
    global $post;
    echo 'トップ画像<br><input value="'. get_post_meta($post->ID, 'menu_img', true).'" name="menu_img"><br>';
}
function custom_area6(){
    global $post;
    echo '電話番号<br><input value="'. get_post_meta($post->ID, 'reserved_tel', true).'" name="reserved_tel"><br>';
    echo '平日<br><input value="'. get_post_meta($post->ID, 'reserved_weekday', true).'" name="reserved_weekday"><br>';
    echo '休日<br><input value="'. get_post_meta($post->ID, 'reserved_holiday', true).'" name="reserved_holiday"><br>';
    echo '定休日<br><input value="'. get_post_meta($post->ID, 'reserved_regular_holiday', true).'" name="reserved_regular_holiday"><br>';
    echo 'WEB予約リンク(URL)<br><input value="'. get_post_meta($post->ID, 'reserved_web_link', true).'" name="reserved_web_link"><br>';
    echo 'WEB予約説明 入力欄<br><textarea cols="50" rows="5" name="reserved_web">'. get_post_meta($post->ID, 'reserved_web', true). '</textarea><br>';
    echo 'アプリ予約リンク(URL)<br><input value="'. get_post_meta($post->ID, 'reserved_app_link', true).'" name="reserved_app_link"><br>';
    echo 'アプリ予約説明 入力欄<br><textarea cols="50" rows="5" name="reserved_app">'. get_post_meta($post->ID, 'reserved_app', true). '</textarea><br>';
}



function save_custom_postdata($post_id){
    edit_db_data('home_top_img', 'home_top_img', $post_id);
    edit_db_data('home_top_img_text', 'home_top_img_text', $post_id);
    edit_db_data('home_top_img_text_sub', 'home_top_img_text_sub', $post_id);
    edit_db_data('home_about_msg', 'home_about_msg', $post_id);
    edit_db_data('home_about_img', 'home_about_img', $post_id);
    edit_db_data('home_staff_msg', 'home_staff_msg', $post_id);
    for($i=1; $i<=4; $i++){
        edit_db_data('home_staff_name'. $i. '_romaji', 'home_staff_name'. $i. '_romaji', $post_id);
        edit_db_data('home_staff_name'. $i. '_kanji', 'home_staff_name'. $i. '_kanji', $post_id);
        edit_db_data('home_staff_img'. $i, 'home_staff_img'. $i, $post_id);
        edit_db_data('home_staff_url'. $i, 'home_staff_url'. $i, $post_id);
    }
    edit_db_data('map', 'map', $post_id);
    edit_db_data('about_top_img', 'about_top_img', $post_id);
    edit_db_data('about_concept_msg', 'about_concept_msg', $post_id);
    edit_db_data('staff_list_top_img', 'staff_list_top_img', $post_id);
    edit_db_data('staff_list_msg', 'staff_list_msg', $post_id);
    edit_db_data('staff_img', 'staff_img', $post_id);
    edit_db_data('staff_romaji', 'staff_romaji', $post_id);
    edit_db_data('staff_kanji', 'staff_kanji', $post_id);
    edit_db_data('staff_msg', 'staff_msg', $post_id);
    for($i=1; $i<=7; $i++){
        edit_db_data('staff_schedule'. $i, 'staff_schedule'. $i, $post_id);
    }
    edit_db_data('menu_img', 'menu_img', $post_id);
    edit_db_data('reserved_tel', 'reserved_tel', $post_id);
    edit_db_data('reserved_weekday', 'reserved_weekday', $post_id);
    edit_db_data('reserved_holiday', 'reserved_holiday', $post_id);
    edit_db_data('reserved_regular_holiday', 'reserved_regular_holiday', $post_id);
    edit_db_data('reserved_web', 'reserved_web', $post_id);
    edit_db_data('reserved_app', 'reserved_app', $post_id);
    edit_db_data('reserved_web_link', 'reserved_web_link', $post_id);
    edit_db_data('reserved_app_link', 'reserved_app_link', $post_id);
    edit_db_data('home_about_url', 'home_about_url', $post_id);
    edit_db_data('home_staff_list_url', 'home_staff_list_url', $post_id);
    edit_db_data('home_news_list_url', 'home_news_list_url', $post_id);
    edit_db_data('home_blog_list_url', 'home_blog_list_url', $post_id);
}
function edit_db_data($post_key, $db_key, $post_id){
    $msg = '';
    if(isset($_POST[$post_key])){
        $msg = $_POST[$post_key];
    }
    if(preg_match("/<iframe/", $msg)){
        $msg = str_replace('width=\"600\"', '', $msg);
    }
    if($msg != get_post_meta($post_id, $db_key, true)){
        update_post_meta($post_id, $db_key, $msg);
    }elseif($msg == ''){
        delete_post_meta($post_id, $db_key, get_post_meta($post_id, $db_key, true));
    }
}

//カスタムウィジェット
add_action('widgets_init', 'my_widgets_area');
add_action('widgets_init', function(){
    register_widget('my_widgets_item1');
    register_widget('my_widgets_item2');
    register_widget('my_widgets_item3');
    register_widget('my_widgets_item4');
    register_widget('my_widgets_item5');
    register_widget('my_widgets_item6');
    register_widget('my_widgets_item7');
    register_widget('my_widgets_item8');
    register_widget('my_widgets_item9');
    register_widget('my_widgets_item10');
});

function my_widgets_area(){
    register_sidebar(array(
        'name' => '-ABOUT-コンセプトエリア',
        'id' => 'widget_about_concept',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-ABOUT-アクセスエリア',
        'id' => 'widget_about_access',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-STAFF一覧-エリア',
        'id' => 'widget_staff_list',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-MENU-エリア',
        'id' => 'widget_menu',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-TOP予約-エリア',
        'id' => 'widget_reserved',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-SNSアイコン-エリア',
        'id' => 'widget_sns',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-予約ボタン-エリア',
        'id' => 'widget_btn',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-ALLSTAFFボタン-エリア',
        'id' => 'widget_btn_allstaff',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-フッター-エリア',
        'id' => 'widget_footer',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => '-BLOG一覧ー-エリア',
        'id' => 'widget_blog_no_img',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
}

class my_widgets_item1 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-ABOUT-コンセプトウィジェット');
    }
    function form($instance){
        $img = esc_attr($instance['img']);
        $title = esc_attr($instance['title']);
        $body = esc_attr($instance['body']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('img');?>">
                <?php echo '画像URL';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('img');?>" name="<?php echo $this->get_field_name('img');?>" value="<?php echo $img;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">
                <?php echo 'タイトル';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $title;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('body');?>">
                <?php echo '内容';?>
            </label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('body');?>" name="<?php echo $this->get_field_name('body');?>"><?php echo $body;?></textarea>
        </p>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['img'] = strip_tags($new_instance['img']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['body'] = trim($new_instance['body']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $img = apply_filters('widget_title', $instance['img']);
        $title = apply_filters('widget_title', $instance['title']);
        $body = apply_filters('widget_body', $instance['body']);
        if($title){
    ?>
        <div class="p-concept-card u-fuwa">
            <img class="p-concept-card__img" src="<?php show_img_widget($img, $title);?>" alt="CONCEPT画像">
            <h3 class="p-concept-card__title"><?php echo $title;?></h3>
            <p class="c-text__body">
                <?php echo $body;?>
            </p>
        </div>
    <?php
        }
    }
}

class my_widgets_item2 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-ABOUT-アクセスウィジェット');
    }
    function form($instance){
        $title = esc_attr($instance['title']);
        $body = esc_attr($instance['body']);
    ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">
                <?php echo 'タイトル';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $title;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('body');?>">
                <?php echo '内容';?>
            </label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('body');?>" name="<?php echo $this->get_field_name('body');?>"><?php echo $body;?></textarea>
        </p>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['body'] = trim($new_instance['body']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $body = apply_filters('widget_body', $instance['body']);
        if($title){
    ?>
        <li class="p-info-list__item">
            <span class="p-info-list__item__title"><?php echo $title;?></span>
            <span class="p-info-list__item__body"><?php echo $body;?></span>
        </li>
    <?php
        }
    }
}

class my_widgets_item3 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-STAFF一覧-ウィジェット');
    }
    function form($instance){
        $page = esc_attr($instance['page']);
        $img = esc_attr($instance['img']);
        $title = esc_attr($instance['title']);
        $body = esc_attr($instance['body']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('page');?>">
                <?php echo 'スタッフページ(URL)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('page');?>" name="<?php echo $this->get_field_name('page');?>" value="<?php echo $page;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('img');?>">
                <?php echo 'スタッフ画像(URL)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('img');?>" name="<?php echo $this->get_field_name('img');?>" value="<?php echo $img;?>"/>
        </p>    
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">
                <?php echo 'スタッフ名(ローマ字)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $title;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('body');?>">
                <?php echo 'スタッフ名(漢字)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('body');?>" name="<?php echo $this->get_field_name('body');?>" value="<?php echo $body;?>"/>
        </p>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['page'] = strip_tags($new_instance['page']);
        $instance['img'] = strip_tags($new_instance['img']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['body'] = trim($new_instance['body']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $page = apply_filters('widget_page', $instance['page']);
        $img = apply_filters('widget_img', $instance['img']);
        $title = apply_filters('widget_title', $instance['title']);
        $body = apply_filters('widget_body', $instance['body']);
        if($title){
    ?>
        <li class="c-card u-fuwa">
            <a href="<?php echo $page;?>" class="c-card__img-wrapper">
                <img class="c-card__img-wrapper__img" src="<?php show_img_widget($img, $title);?>" alt="スタッフの写真">
                <div class="c-card__img-wrapper__cover">
                    <div class="c-card__img-wrapper__cover__text">Profile & Schedule</div>
                    <i class="c-card__img-wrapper__cover__angle fas fa-angle-double-right"></i>
                </div>
            </a>
            <div class="c-card__name--sub"><?php echo $title;?></div>
            <div class="c-card__name"><?php echo $body;?></div>
        </li>
    <?php
        }
    }
}

class my_widgets_item4 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-MENU-ウィジェット');
    }
    function form($instance){
        $title = esc_attr($instance['title']);
        $course = array();
        $price = array();
        $detail = array();
        for($i=1; $i<=10; $i++){
            array_push($course, esc_attr($instance['course'.$i]));
            array_push($price, esc_attr($instance['price'.$i]));
            array_push($detail, esc_attr($instance['detail'.$i]));
        }
    ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">
                <?php echo 'メニューの種類';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $title;?>"/>
        </p>
        <?php for($i=1; $i<=10; $i++):?>
            <p>
                <label for="<?php echo $this->get_field_id('course'. $i);?>">
                    <?php echo 'メニュー名-'.$i;?>
                </label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('course'. $i);?>" name="<?php echo $this->get_field_name('course'. $i);?>" value="<?php echo $course[$i - 1];?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('price'. $i);?>">
                    <?php echo '値段-'. $i;?>
                </label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('price'. $i);?>" name="<?php echo $this->get_field_name('price'. $i);?>" value="<?php echo $price[$i - 1];?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('detail'. $i);?>">
                    <?php echo '詳細-'. $i;?>
                </label>
                <textarea type="text" class="widefat" id="<?php echo $this->get_field_id('detail'. $i);?>" name="<?php echo $this->get_field_name('detail'. $i);?>"><?php echo $detail[$i - 1];?></textarea>
            </p>
        <?php endfor;?>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        for($i=1; $i<=10; $i++){
            $instance['course'. $i] = strip_tags($new_instance['course'. $i]);
            $instance['price'. $i] = strip_tags($new_instance['price'. $i]);
            $instance['detail'. $i] = strip_tags($new_instance['detail'. $i]);
        }
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        for($i=1; $i<=10; $i++){
            $course[$i] = apply_filters('widget_course'. $i, $instance['course'. $i]);
            $price[$i] = apply_filters('widget_price'. $i, $instance['price'. $i]);
            $detail[$i] = apply_filters('widget_detail'. $i, $instance['detail'. $i]);
        }
        if($title){
    ?>
        <div class="p-course u-fuwa">
            <h2 class="p-course__title"><?php echo $title;?></h2>
            <ul class="p-course__body">
                <?php for($i=1; $i<=10; $i++):?>
                    <?php if($course[$i]):?>
                        <li class="">
                            <div class="p-course__item">
                                <span><?php echo $course[$i];?></span>
                                <span><?php echo $price[$i];?></span>
                            </div>
                            <p class="p-course__detail">
                                <?php echo $detail[$i];?>
                            </p>
                        </li>
                    <?php endif;?>
                <?php endfor;?>
            </ul>
        </div>
    <?php
        }
    }
}

class my_widgets_item5 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-TOP予約-ウィジェット');
    }
    function form($instance){
        $tel = esc_attr($instance['tel']);
        $web = esc_attr($instance['web']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('tel');?>">
                <?php echo '電話番号';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('tel');?>" name="<?php echo $this->get_field_name('tel');?>" value="<?php echo $tel;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('web');?>">
                <?php echo 'WEB予約(URL)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('web');?>" name="<?php echo $this->get_field_name('web');?>" value="<?php echo $web;?>"/>
        </p>    
        
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['tel'] = strip_tags($new_instance['tel']);
        $instance['web'] = trim($new_instance['web']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $tel = apply_filters('widget_tel', $instance['tel']);
        $web = apply_filters('widget_web', $instance['web']);
        if($tel){
    ?>
        <a href="tel:<?php echo $tel;?>">Tel <?php echo $tel;?></a>
        <a href="<?php echo $web;?>"  class="c-btn p-sp-menu-right__web">Web予約</a>

        <?php
        }
    }
}

class my_widgets_item6 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-SNSアイコン-ウィジェット');
    }
    function form($instance){
        $fb = esc_attr($instance['fb']);
        $ig = esc_attr($instance['ig']);
        $tw = esc_attr($instance['tw']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('fb');?>">
                <?php echo 'Facebook(URL)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('fb');?>" name="<?php echo $this->get_field_name('fb');?>" value="<?php echo $fb;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ig');?>">
                <?php echo 'Instagram(URL)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('ig');?>" name="<?php echo $this->get_field_name('ig');?>" value="<?php echo $ig;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tw');?>">
                <?php echo 'Twitter(URL)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('tw');?>" name="<?php echo $this->get_field_name('tw');?>" value="<?php echo $tw;?>"/>
        </p>     
        
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['fb'] = strip_tags($new_instance['fb']);
        $instance['ig'] = strip_tags($new_instance['ig']);
        $instance['tw'] = strip_tags($new_instance['tw']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $fb = apply_filters('widget_fb', $instance['fb']);
        $ig = apply_filters('widget_ig', $instance['ig']);
        $tw = apply_filters('widget_tw', $instance['tw']);
        if($fb){
    ?>
        <a href="<?php echo $fb;?>" class="fa-stack p-sns-icon">
            <i class="p-sns-icon__circle fas fa-circle fa-stack-2x"></i>
            <i  class="p-sns-icon__font fab fa-facebook-f fa-stack-1x "></i>
        </a>
        <a href="<?php echo $ig;?>" class="fa-stack p-sns-icon">
            <i class="p-sns-icon__circle fas fa-circle fa-stack-2x"></i>
            <i class="p-sns-icon__font fab fa-instagram fa-stack-1x "></i>
        </a>
        <a href="<?php echo $tw;?>" class="fa-stack p-sns-icon">
            <i class="p-sns-icon__circle fas fa-circle fa-stack-2x"></i>
            <i class="p-sns-icon__font fab fa-twitter fa-stack-1x "></i>
        </a>

        <?php
        }
    }
}

class my_widgets_item7 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-ボタン-予約');
    }
    function form($instance){
        $link = esc_attr($instance['link']);
        $title = esc_attr($instance['title']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('link');?>">
                <?php echo 'リンクURL';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('link');?>" name="<?php echo $this->get_field_name('link');?>" value="<?php echo $link;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">
                <?php echo 'テキスト';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $title;?>"/>
        </p>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $link = apply_filters('widget_link_btn', $instance['link']);
        $title = apply_filters('widget_link_btn_text', $instance['title']);
        if($link){
    ?>
        <a href="<?php echo $link;?>"  class="c-btn"><?php echo $title;?></a>
        <?php
        }
    }
}

class my_widgets_item8 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-ボタン-ALLSTAFF');
    }
    function form($instance){
        $link = esc_attr($instance['link']);
        $text = esc_attr($instance['text']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('link');?>">
                <?php echo 'リンクURL';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('link');?>" name="<?php echo $this->get_field_name('link');?>" value="<?php echo $link;?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text');?>">
                <?php echo 'テキスト';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('text');?>" name="<?php echo $this->get_field_name('text');?>" value="<?php echo $text;?>"/>
        </p>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['text'] = strip_tags($new_instance['text']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $link = apply_filters('widget_link_btn', $instance['link']);
        $text = apply_filters('widget_link_btn_text', $instance['text']);
        if($link){
    ?>
        <a href="<?php echo $link;?>"  class="c-btn"><?php echo $text;?></a>
        <?php
        }
    }
}

class my_widgets_item9 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-フッター-ウィジェット');
    }
    function form($instance){
        $title = esc_attr($instance['title']);
        $course = array();
        for($i=1; $i<=4; $i++){
            array_push($course, esc_attr($instance['course'.$i]));
        }
    ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">
                <?php echo 'Copyright';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $title;?>"/>
        </p>
        <?php for($i=1; $i<=4; $i++):?>
            <p>
                <label for="<?php echo $this->get_field_id('course'. $i);?>">
                    <?php echo '情報-'.$i;?>
                </label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('course'. $i);?>" name="<?php echo $this->get_field_name('course'. $i);?>" value="<?php echo $course[$i - 1];?>"/>
            </p>
        <?php endfor;?>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        for($i=1; $i<=4; $i++){
            $instance['course'. $i] = strip_tags($new_instance['course'. $i]);
        }
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        for($i=1; $i<=4; $i++){
            $course[$i] = apply_filters('widget_course'. $i, $instance['course'. $i]);
        }
        if($title){
    ?>
        <div class="p-footer">
            <p class=""><?php echo $course[1];?></p>
            <p class=""><?php echo $course[2];?></p>
            <p class=""><?php echo $course[3];?></p>
            <p class=""><?php echo $course[4];?></p>
        </div>

        <div>
            <?php echo $title; ?>
        </div>
    <?php
        }
    }
}

class my_widgets_item10 extends WP_Widget{
    function __construct(){
        parent::__construct(false, $name = '-BLOG一覧-NoImageウィジェット');
    }
    function form($instance){
        $title = esc_attr($instance['title']);
    ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">
                <?php echo 'No Image画像(URL)';?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo $title;?>"/>
        </p>
    <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        if($title):?>
            <img src="<?php echo $title;?>" alt="NO-IMAGE">
        <?php else:?>
            <img src="<?php echo get_template_directory_uri(). '/src/images/'. NO_IMG;?>" alt="NO=IMAGE">
        <?php endif; ?>
    <?php
        
    }
}