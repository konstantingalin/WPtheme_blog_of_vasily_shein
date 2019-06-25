	<?php get_header(); ?>
	<div class="bread_crumbs_1">
		<div class="container">
			<div class="row">
				<div class="col-xl-9 col-lg-9 col-md-12">
					<ul class="bread_crumbs">
						<li><a href="<?php echo home_url(); ?>">Блог Василия Шеин <span>/</span> </a></li>
						<li><a href="<?php echo home_url() . '/category/'; ?>">Жанры <span>/</span> </a></li>
						<?php
							$category = get_the_category(); 
							echo '<li><a href="' . get_category_link($category[0]->cat_ID) . '">' . $category[0]->cat_name . ' <span>/</span></a></li>';
						?> 
						<li><a href=""><i><?php $page_title = the_title(); ?></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<section class="all_content isarticle">
		<div class="container">
			<div class="row">
				<div class="col-xl-9 col-lg-9 col-md-12">
					
					<!-- Вывод статьи -->
					<?php if(have_posts()):?>
						<?php while(have_posts()):?>
							<?php the_post();?>
							<article class="top_article">
								<?php if(has_post_thumbnail()):?>
									<?php the_post_thumbnail(); ?>
								<?php else: ?>
									<img src="https://picsum.photos/1000/1000" alt="Картинка поста">
								<?php endif; ?>
								<div class="date_post">
									<span>
										<?php 
											$_mD = substr(get_the_date(), 2, 4);
											echo substr(get_the_date(), 0, 2) . ' ' . $_monthsList[$_mD] . ' ' . substr(get_the_date(), 6, 9);
										?>
									</span>
								</div>
								<h2><?php the_title(); ?></h2>
								<?php the_content(); ?>
								<div class="hashtags">
									<?php
										$posttags = get_the_tags();
										if ( $posttags ) {
											foreach( $posttags as $tag ) {
												echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
											}
										}
									?>
								</div>
								<div class="numbers_of_post">
	
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
								</div>
							</article>
							
							<!-- Похожие статьи -->
							<div class="similar_publications">
								<h3>Похожие публикации</h3>
								<div class="owl-carousel article-carousel">
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
							<!-- Конец похожих статей -->
							
							<!-- Коментарии -->
							<?php
								if(comments_open() || get_comments_number()){
									comments_template();	
								}
							?>
						<?php endwhile; ?>
					<?php endif; ?>
				<!-- Конец вывода статьи статьи -->
 				</div>
				<!-- Сайдбар -->	
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>
	<?php get_footer(); ?>