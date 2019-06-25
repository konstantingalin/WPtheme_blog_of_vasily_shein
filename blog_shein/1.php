
						<div class="popular_sidebar">
							<h2>Популярные публикации</h2>
							<?php
							$args = array(
								'numberposts' => 3,
								'post_type' => 'post',
								'suppress_filters' => 'true'
							);
							$posts = get_posts( $args );
							
							foreach($posts as $post) { setup_postdata($post);
								?>
								<div class='popular_sidebar_one'>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<p class="date_post_sidebar">
									<?php
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
									<p class="like_post_sidebar" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/icons/eye.svg'; ?>)">
									<?php 
										if(get_post_meta ($post->ID,'views',true)){
											echo get_post_meta ($post->ID,'views',true);
										} else{ echo 0;}
									?>
									</p>
								</div>
								<?php  
							}
							wp_reset_postdata();
							?>
							<div class="watch_all_sidebar">
								<a href="<?php echo home_url(); ?>">Показать все 17</a>
							</div>
						</div>