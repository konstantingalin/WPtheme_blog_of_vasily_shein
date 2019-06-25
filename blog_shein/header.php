<!doctype html>
<html lang="ru">
<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
  <title>«Литературный блог Василия Шеин»</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
 	<!-- Shortcut icons -->
 	<meta property="og:image" content="path/to/image.jpg">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/assets/images/favicon/favicon.ico';?>" type="image/x-icon">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() . '/assets/images/favicon/apple-touch-icon.png'; ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() . '/assets/images/favicon/apple-touch-icon-72x72.png'; ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() . '/assets/images/favicon/apple-touch-icon-114x114.png'; ?>">
 	
 	<!-- Подключение шрифтов -->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#ffffff">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#ffffff">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">
	<?php wp_head(); ?>
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
					<h1>
						<a href="<?php echo home_url(); ?>"><span>Литературный блог</span><br>Василия Шеин</a>
					</h1>
				</div>
				<div class="col-xl-6 col-lg-8 col-md-7 col-sm-4 col-4">
					<nav>
						<ul>
							<li><a class="active_menu" href="<?php echo home_url(); ?>">Главная</a></li>
							<li class="list_menu">
								<a>Жанры</a>
								<ul class="dropdown_menu">
									<?php
									$genre = get_categories();
									if ( $genre ) {
										foreach( $genre as $link ) {
											echo '<li><a href="' . get_category_link($link->term_id) . '">' . $link->name . '</a></li>';
										}
									}
								?>
								</ul>
							</li>
							<li><a href="">Избранное</a></li>
							<li><a href="">Новое</a></li>
							<li><a href="">Контакты</a></li>
						</ul>
					</nav>	
					<nav class="nav_mobile">
						<ul>
							<li class="list_menu_mobile">
								<a href="#"><p>Меню</p></a>
								<ul class="dropdown_menu">
									<li><a href="<?php echo home_url(); ?>">Главная</a></li>
									<li  class="list_menu_mobile_two">
										<a>Жанры</a>
										<ul class="dropdown_menu_two">
											<?php
												$genre = get_categories();
												if ( $genre ) {
													foreach( $genre as $link ) {
														echo '<li><a href="' . get_category_link($link->term_id) . '">' . $link->name . '</a></li>';
													}
												}
											?>
										</ul>
									</li>
									<li><a href="">Избранное</a></li>
									<li><a href="">Новое</a></li>
									<li><a href="">Контакты</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
				<div class="col-xl-3 col-lg-1 col-md-1 col-sm-2 col-2">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</header>