 <?php
/*
Template Name: O-bloge
*/
?>
<?php get_header(); ?>
<section class="o-bloge">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<img src="<?php echo get_template_directory_uri() . '/assets/images/shein.png'?>" alt="Фото Василий Шеин">
				<h2 class="obh3">Уважаемый читатель!</h2>
				<p>
					Приветствую! Меня зовут 
					Василий Шеин, и я писатель. 
					Пишу в жанрах: детективы, психологические триллеры и мистика. Надеюсь, тебе здесь понравится! ;)
				</p>
				<p>
					Писательской деятельностью начал заниматься с 12 лет. Работал во многих направлениях жанров: мистика и ужасы. Каждый день стараюсь выкладывать по новой главе своей книги “О, этот прекрасный Мир!”
				</p>
				<div class="soc">
					<a href="https://vk.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/vk.svg'?>" alt="Вконтакте"></a>
					<a href="https://instagram.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/instagram.svg'?>" alt="Инстаграм"></a>
					<a href="https://facebook.com/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/soc/facebook.svg' ?>" alt="Фэйсбук"></a>
				</div>
				<img src="<?php echo get_template_directory_uri() . '/assets/images/signature.png' ?>" alt="Подпись автора">
			</div>
			<div class="col-lg-12">
				<div class="similar_publications">
					<h3>Возможно вас заинтересует</h3>
					<div class="owl-carousel o-bloge-carousel">
						<?php
						$postID = get_post_time();

						$args = array(
							'numberposts' => 9,
							'post_type' => 'post',
							'suppress_filters' => 'true',
							'orderby' => 'rand'
						);
						$posts = get_posts( $args );

						foreach($posts as $post) { setup_postdata($post);
							?>
							<?php if($postID != get_post_time()):?>
								<div class="similar_articles">
									<?php if(has_post_thumbnail()):?>
											<?php the_post_thumbnail(); ?>
										<?php else: ?>
											<img src="https://picsum.photos/1000/1000" alt="Картинка поста">
										<?php endif; ?>
										<h4>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h4>
									</div>
								<?php endif; ?> 
								<?php  
							}
							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>