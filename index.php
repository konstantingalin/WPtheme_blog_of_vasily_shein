<?php get_header(); ?>
	<section class="all_content">
		<div class="container">
			<div class="row">
				<div class="col-xl-9 col-lg-9 col-md-12">
					<!-- Вывод информации о блоге на мобильных устройствах -->
					<?php include 'author_info.php'; ?>
					<!-- Вывод статей -->
					
					<?php if(have_posts()):?>
						<?php while(have_posts()):?>
							<?php the_post();?>
							<article class="art_post">
								<?php the_post_thumbnail(); ?>
								<div class="date_post">
									<span>
										<?php 
											$_mD = substr(get_the_date(), 2, 4);
											echo substr(get_the_date(), 0, 2) . ' ' . $_monthsList[$_mD] . ' ' . substr(get_the_date(), 6, 9);
										?>
									</span>
								</div>
								<ul class="hashtags">
									<?php
										$posttags = get_the_tags();
										if ( $posttags ) {
											foreach( $posttags as $tag ) {
												echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
											}
										}
									?>
								</ul>
								<h2><?php the_title(); ?></h2>
								<p><?php the_excerpt(); ?></p>
								<a href="<?php the_permalink(); ?>" class="button">Читать далее</a>
								<ul class="numbers_of_post">
									<li><a name="eye" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/icons/eye.svg'; ?>)">
									<?php 
										if(get_post_meta ($post->ID,'views',true)){
											echo get_post_meta ($post->ID,'views',true);
										} else{ echo 0;}
									?>
									</a></li>
									<li><a name="comment" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/icons/comment.svg'; ?>)"><?php echo get_comments_number();?></a></li>
									<li>
									<?php
											$likes = get_post_likes($post->ID);
											$iLike = is_my_post_like($post->ID);
										?>
										<a name="heart" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/icons/heart.svg'; ?>)" class="like-button" data-like="<?=$post->ID?>" data-like-is="<?=intval($iLike)?>" data-like-title-tmpl="Понравилось #" title="Понравилось <?=$likes?>"><?=$likes?></a>
									</li>
								</ul>
								<a href="<?php the_permalink(); ?>" class="button button_320">Читать далее</a>
							</article>
						<?php endwhile; ?>
					<?php else: ?>
							<p>Публикаций нет...</p>
					<?php endif; ?>
					<!-- Конец вывода статей -->
					
					<!-- Навигация -->
					<?php the_posts_pagination(array(
						'show_all' => false,
						'end_size' => 1,
						'mid_size' => 2,
						'type' => 'list',
					)); ?> 
				</div>
				<!-- Сайдбар -->	
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>