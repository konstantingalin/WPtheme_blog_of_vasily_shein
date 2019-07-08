		<footer>
			<div class="container">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4">
						<div class="footer_last_publication">
							<h2>Последние публикации</h2>
							<ul>
							<?php
							$args = array(
								'numberposts' => 3,
								'post_type' => 'post',
								'suppress_filters' => 'true'
							);
							$posts = get_posts( $args );
							
							foreach($posts as $post) { setup_postdata($post);
								?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<p><?php
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
											$_mD = substr(get_the_date(), 2, 4);
											echo substr(get_the_date(), 0, 2) . ' ' . $_monthsList[$_mD] . ' ' . substr(get_the_date(), 6, 9);
										?></p>
								</li>
								<?php  
							}
							wp_reset_postdata();
							?>
							</ul>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4">
						<div class="sub_email">
							<h2>Подпишись на обновления</h2>
							<h3>Узнай первым о новых публикациях<br/> и получи подарок!</h3>
							<div class="sub">
								<form>
									<input type="email" placeholder="Электронная почта">
									<input type="submit" value="">
								</form>
							</div>
							<div class="soc">
								<a href="https://vk.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/vk.svg'?>" alt="Вконтакте"></a>
								<a href="https://instagram.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/instagram.svg'?>" alt="Инстаграм"></a>
								<a href="https://facebook.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/facebook.svg' ?>" alt="Фэйсбук"></a>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4">
						<div class="blog_info">
							<h2><span>Литературный блог</span><br>Василия Шеин</h2>
							<p>Писательской деятельностью начал заниматься с 12 лет. Работал во многих направлениях жанров: мистика и ужасы. Каждый день стараюсь выкладывать по новой главе своей книги “О, этот прекрасный Мир!”
							</p>
							<p>© 2019 Литературный блог Василия Шеин.<br>
							Все права защищены.</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<div class="top">Наверх</div>	
  	<?php wp_footer(); ?>
	</body>
</html>