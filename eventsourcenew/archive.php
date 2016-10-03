<?php
/*
Template Name: My Custom Page
*/

get_header();
//require(WEBTREATS_INCLUDES . "/var.php");
?>
<div class="col-md-9 col-xs-12">
	<div class="row">
		<div id="primary" class="blog-posts posts-block">
			<div id="content">
				<div class="row">
					<div id="load-next-post">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div <?php post_class('page-blog col-xs-12 content-blog search-result-block') ?> id="post-<?php the_ID(); ?>">
							<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
							<hr/>
							<div class="top_metadata clearfix">
								<div class="author-avatar">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
										<?php echo get_avatar(get_the_author_meta('ID'), 70, '', '', array('height' => 70, 'weight' => 70)); ?>
									</a>
								</div>
								<div class="adddination-info">
									<div class="author-name ">
										<?php the_author_posts_link(); ?>
									</div>
									<div class="post-info">
										<div class="date">
												<span
													class="sub-title"><?php the_time('F j, Y') //the_time('M j') ?></span>
										</div>
										<div class="comments">
												<span class="sub-content"><?php _e('Comments'); ?>
													<?php if (comments_open(get_the_ID()) && wp_count_comments(get_the_ID())->total_comments > 0) {
														$comments_count = wp_count_comments(get_the_ID());
														echo '<a class="not-padding-link" href="' . get_permalink() . '#wp-comments" title="">(' . $comments_count->approved . ')</a>';
													} else { ?>
														<a class="not-padding-link"
														   href="<?php the_permalink(); ?>#comments" title="">(<fb:comments-count href="<?php the_permalink(); ?>"
																																  fb-xfbml-state="rendered" class="">
																<span class="fb_comments_count"></span>
															</fb:comments-count>)</a>
													<?php } ?>
												</span>
										</div>
										<div class="categories">
											<?php
											$cats = get_the_category_list(', ');
											if ($cats) { ?>
												<span class="sub-title"><?php _e('Category: '); ?></span><span
													class="sub-content"><?php echo $cats; ?></span>
												<?php
											}
											?>
										</div>
									</div>
								</div>


							</div>
							<!-- top_metadata -->
							<div class="row">
								<?php if(has_post_thumbnail()): ?>
								<div class="col-sm-6 col-md-6">
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail('full'); ?>
									</a>
								</div>
								<div class="col-sm-6 col-md-6">
									<?php else: ?>
									<div class="col-md-12">
										<?php endif; ?>
										<?php the_excerpt(); ?>
										<a href="<?php the_permalink() ?>" class="readmore-link">
											<?php _e('Read more...');?>
										</a>
									</div>
									<!--                                --><?php //$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
									<!--                                <div class="content-blog" style="background-image: url('--><?php //echo $thumb_url;?>
									<!--                                /*')">*/-->
									<!--                                    <div class="inner-blog-content">-->
									<!--                                        <div class="top_metadata left-red-block with-hr clearfix">-->
									<!--                                            <h1 class="title"><a-->
									<!--                                                    href="-->
									<?php //the_permalink() ?><!--">--><?php //the_title(); ?><!--</a>-->
									<!--                                            </h1>-->
									<!--                                        </div>-->
									<!--                                        <!-- inner-blog-content -->
									<!--                                    </div>-->
									<!-- content-blog -->
									<!--                                    <div class="overflow col-xs-12">-->
									<!--                                        <div class="title-over">-->
									<!--                                            --><?php //the_title(); ?>
									<!--                                        </div>-->
									<!--                                    </div>-->
									<!--                                </div>-->
									<!-- post_ID -->
								</div>
							</div>
							<?php endwhile; ?>
							<?php else : ?>
								<h2><?php _e('Sorry, no posts matched your criteria.'); ?></h2>
							<?php endif; ?>
						</div>
					</div>

					<!-- load_next_post -->

					<!--                <div id="alignright">--><?php //next_posts_link('More Articles') ?><!--</div>-->
					<div id="blog-pagination">
						<?php the_posts_pagination(); ?>
					</div>
				</div>
				<!-- content -->
			</div>
			<!-- primary -->
		</div>
	</div>
	<div class="col-md-3 col-xs-12">
		<?php dynamic_sidebar('right-block'); ?>
	</div>


	<?php get_footer(); ?>

