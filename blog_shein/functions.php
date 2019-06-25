<?php

/*
 * Подключение скриптов и стилей
 */
function shein_scripts(){
    wp_enqueue_style('shein-libscss', get_template_directory_uri() . '/assets/css/libs.min.css');
    wp_enqueue_style('style', get_stylesheet_uri());

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), false, true);
    wp_enqueue_script('shein-libsjs', get_template_directory_uri() . '/assets/js/libs.min.js');
		wp_enqueue_script('shein-commonjs', get_template_directory_uri() . '/assets/js/common.js');
		wp_localize_script('shein-commonjs', 'myajax', 
			array(
				'url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('myajax-nonce')
				)
		);
}
add_action('wp_enqueue_scripts', 'shein_scripts');

function shein_setup(){
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'shein_setup');

// Руссификация месяцев в дате
$_monthsList = array(
	".01." => "января",
	".02." => "февраля",
	".03." => "марта",
	".04." => "апреля",
	".05." => "мая",
	".06." => "июня",
	".07." => "июля",
	".08." => "августа",
	".09." => "сентября",
	".10." => "октября",
	".11." => "ноября",
	".12." => "декабря"
);

function shein_widgets_init(){
	register_sidebar(array(
		'name' => 'Сайдбар справа',
		'id' => 'right-sidebar',
		'class' => 'hashtags_sidebar'
	));
}
add_action('widgets_init', 'shein_widgets_init'); 

add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    return '
	<nav class="navigation" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}
the_posts_pagination( array(
    'end_size' => 2,
) );

function law_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'law' ); ?></h2>
            <div class="nav-links">
                <?php
                if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'law' ) ) ) :
                    printf( '<div class="nav-previous">%s</div>', $prev_link );
                endif;

                if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'law' ) ) ) :
                    printf( '<div class="nav-next">%s</div>', $next_link );
                endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .comment-navigation -->
        <?php
    endif;
}

add_action('wp_head', 'kama_postviews');
function kama_postviews() {

/* ------------ Настройки -------------- */
$meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.
$who_count      = 1;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированных пользователей.
$exclude_bots   = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.

global $user_ID, $post;
	if(is_singular()) {
		$id = (int)$post->ID;
		static $post_views = false;
		if($post_views) return true; // чтобы 1 раз за поток
		$post_views = (int)get_post_meta($id,$meta_key, true);
		$should_count = false;
		switch( (int)$who_count ) {
			case 0: $should_count = true;
				break;
			case 1:
				if( (int)$user_ID == 0 )
					$should_count = true;
				break;
			case 2:
				if( (int)$user_ID > 0 )
					$should_count = true;
				break;
		}
		if( (int)$exclude_bots==1 && $should_count ){
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
			$bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
			if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
				$should_count = false;
		}

		if($should_count)
			if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
	}
	return true;
}


if( wp_doing_ajax() ){
	add_action('wp_ajax_like', 'do_like');
	add_action('wp_ajax_nopriv_like', 'do_like');
}

function do_like() {
// простые проверки параметров ajax запроса
	if(!isset($_POST['nonce'], $_POST['post_id'])) die( 'Oops');
	$nonce = $_POST['nonce'];
	$post_id = intval($_POST['post_id']);
	if($post_id <= 0) die( 'Oops');

	// проверяем nonce код, если проверка не пройдена прерываем обработку
	if( ! wp_verify_nonce( $nonce, 'myajax-nonce' ) ) die( 'Oops');
	// обрабатываем данные и возвращаем
// проверяем установлены ли cookie для посетителя и есть ли в них информация по лайку для данного поста
	$my_likes = array();
	if(isset($_COOKIE['wp-likes'])) {
		$my_likes = @json_decode($_COOKIE['wp-likes']);
		if(!is_array($my_likes)) $my_likes = array();
	}
	$isLike = false;
	if(!in_array($post_id, $my_likes)) $my_likes[] = $post_id;	
	else $isLike = true;
// если $isLike == true, посетитель уже голосовал за пост, ему надо просто отдать текущее количество лайков.
	global $wpdb;
//ищем в базе информацию по лайкам данного поста	
	$ps = $wpdb->get_results(sprintf("SELECT * FROM `wp_hp_likes` WHERE `post_id`=%u", $post_id) );

//формируем лог, если лог не нужен удалите следующую строку и другие строки для записи лога
	$log = sprintf("%s\t%s\t%s", time(), GetVisitorIP(), isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
	if(count($ps) == 0) {
//информации по лайкам нет, надо добавить пост с лайком 1
		$likes = 1;
		$wpdb->insert( 'wp_hp_likes', array('post_id'=>$post_id, 'likes' => $likes, 'log' => $log));
	}
	else {
//информации по лайкам есть, если пользователь уже проголосовал ($isLike == true), просто отдаем его количество лайков
		if($isLike) $likes = $ps[0]->likes;
		else {
//обновляем количество лайков, увеличенным на 1
			$likes = $ps[0]->likes + 1;
			$log = $ps[0]->log."\r\n".$log;
			$wpdb->update( 'wp_hp_likes', array('likes' => $likes, 'log' => $log), array('post_id' => $post_id));
		}
	}
//запишем в куки данные по лайках пользователя, чтобы потом отсекать накрутку	
	$_COOKIE['wp-likes'] = json_encode($my_likes);
	setcookie('wp-likes', $_COOKIE['wp-likes'], time() + 30*24*60*60, '/', $_SERVER['HTTP_HOST']);
//выдадим количество лайков
	print $likes;
	wp_die();
}
// вешаем хук для очистки таблицы при удалении поста 
add_action( 'deleted_post', 'h_deleted_post' );
function h_deleted_post( $post_id ){
	global $wpdb;
	$wpdb->query(sprintf('DELETE FROM `wp_hp_likes` WHERE `post_id`=%u', $post_id));
}

// получение IP адреса голосующего
function GetVisitorIP(){
	if (($IP = getenv('HTTP_CLIENT_IP'))===false)
	if (($IP = getenv('HTTP_X_FORWARDED_FOR'))===false)
	if (($IP = getenv('HTTP_X_FORWARDED'))===false)
	if (($IP = getenv('HTTP_FORWARDED_FOR'))===false)
	if (($IP = getenv('HTTP_FORWARDED'))===false)
		$IP = $_SERVER['REMOTE_ADDR'];
	return $IP;
}
// определим, голосовал ли посетитель за пост с id = $post_id (функция возвращает true, если голосовал)
function is_my_post_like($post_id) {
	static $my_likes = false;
	if($my_likes === false) {
		$my_likes = array();
		if(isset($_COOKIE['wp-likes'])) {
			$my_likes = @json_decode($_COOKIE['wp-likes']);
			if(!is_array($my_likes)) $my_likes = array();
		}
	}
	return in_array($post_id, $my_likes);
}

// функция возвращает количество лайков для поста с id = $post_id
function get_post_likes($post_id) {
	global $wpdb;
	$likes = 0;
	$ps = $wpdb->get_results(sprintf("SELECT `likes` FROM `wp_hp_likes` WHERE `post_id`=%u", $post_id) );
	if(count($ps) != 0) $likes = $ps[0]->likes;
	return $likes;
}
