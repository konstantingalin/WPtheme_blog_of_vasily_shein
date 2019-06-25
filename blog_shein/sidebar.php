				<div class="col-xl-3 col-lg-3">	
					<aside>
						<div class="author_info">
							<img src="<?php echo get_template_directory_uri() . '/assets/images/shein.png'?>" alt="Фото Василий Шеин">
							<h3>Уважаемый читатель!</h3>
							<p>
								Приветствую! Меня зовут 
								Василий Шеин, и я писатель. 
								Пишу в жанрах: детективы, психологические триллеры и мистика. Надеюсь, тебе здесь понравится! ;)
							</p>
							<div class="soc">
								<a href="https://vk.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/vk.svg'?>" alt="Вконтакте"></a>
								<a href="https://instagram.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/instagram.svg'?>" alt="Инстаграм"></a>
								<a href="https://facebook.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/facebook.svg' ?>" alt="Фэйсбук"></a>
							</div>
							<img src="<?php echo get_template_directory_uri() . '/assets/images/signature.png' ?>" alt="Подпись автора">
						</div>
						<div class="popular_sidebar">
							<h2>Популярные публикации</h2>
							<?php if (function_exists ('get_most_viewed')): ?>
							<?php get_most_viewed ('post', 3); ?>
							<?php endif; ?>
							<div class="watch_all_sidebar">
								<a href="<?php echo home_url(); ?>">
									Показать все<?php $count_posts = wp_count_posts(); echo ' ' . $published_posts = $count_posts->publish; ?>
									
								</a>
							</div>
						</div>	
						<div class="genre_sidebar">
							<h2>Жанры</h2>
							<ul>
								<?php
									$genre = get_categories();
									if ( $genre ) {
										foreach( $genre as $link ) {
											echo '<li><a href="' . get_category_link($link->term_id) . '">' . $link->name . '<span> ' . $link->category_count . '</span></a></li>';
										}
									}
								?>
							</ul>
						</div>
						<div class="archivieren">
							<h2>Архив публикаций</h2>
							<ul>
								<?php
									$str = '<li>'. wp_get_archives('echo=0&show_post_count=1') .'</li>';
									$str = str_replace('(','', $str);
									$str = str_replace(')','', $str);
									echo $str;
								?>
							</ul>
						</div>
						<div class="hashtags_sidebar">
							<h2>Популярные метки</h2>
							<ul>
								<?php
									$posttags = get_tags();
									if ( $posttags ) {
										foreach( $posttags as $tag ) {
											echo '<li><a href="' . get_category_link($tag->term_id) . '">' . $tag->name . '</a></li>';
										}
									}
								?>
							</ul>
						</div>
					</aside>
				</div>