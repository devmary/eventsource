<?php
/*
Template Name: My Custom Page
*/

get_header();
//require(WEBTREATS_INCLUDES . "/var.php");
?>
<div class="col-md-9 col-xs-12 main-content-block">
	<div class="row">
		<div id="primary" class="blog-posts single">
			<div id="content">
					<div <?php post_class('page-blog') ?> id="post-<?php the_ID(); ?>">
						<div class="content-blog">
							<div class="inner-blog-content">
								<div class="top_metadata left-red-block with-hr clearfix">
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
														   href="<?php the_permalink(); ?>#comments" title="">(
															<fb:comments-count href="<?php the_permalink(); ?>"
																			   fb-xfbml-state="rendered" class="">
																<span class="fb_comments_count"></span>
															</fb:comments-count>
															)</a>
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
								<div class="post-content">
									<?php the_content(); ?>
								</div>
							</div>
							<!-- inner-blog-content -->
							<div class="icon-social">
								<?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
								<ul>
									<li class="witter tooltip"><a
											href="http://twitter.com/home?status=<?php the_permalink(); ?>"
											target="_blank">Twitter</a><span>Tweet It</span></li>
									<li class="facebook tooltip"><a
											href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>"
											target="_blank">Facebook</a><span>Share at Facebook</span></li>
									<li class="google tooltip"><a
											href="http://plus.google.com/share?url=<?php the_permalink(); ?>"
											target="_blank">Google+</a><span>Share at Google+</span></li>
									<li class="pinterest tooltip"><a
											href="http://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $url; ?>"
											target="_blank">Pinterest</a><span>Share at Pinterest</span></li>
									<li class="linkedin tooltip"><a
											href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>"
											target="_blank">Linkedin</a><span>Share at Linkedin</span></li>
									<li class="email tooltip"><a
											href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>"
											target="_blank">Email</a><span>Share via Email</span></li>
								</ul>
							</div>
							<!-- icon-social -->
							<div class="clearfix"></div>
							<?php $featured_vendor_single = TRUE; include('featured-vendors.php'); ?>
						</div>
						<!-- content-blog -->
					</div><!-- post_ID -->
					<div id="comments">
						<?php echo do_shortcode('[fbcomments url="'.get_the_permalink().'" width="650" count="off" num="5" countmsg="wonderful comments!"]'); ?>
					</div>

			</div>
			<!-- content -->

		</div>
		<!-- primary -->
	</div>
</div>
<div class="col-md-3 col-xs-12 widgets-block">
	<?php dynamic_sidebar('right-block'); ?>
	<div class="clearfix"></div>
	<div id="vendors-shortcuts-widget-container" class="col-md-12 hidden-sm hidden-xs right-block-widget">
		<div id="vendors-shortcuts-widget" class="widget widget_vendors_shortcuts">
		<?php if (count($featured-vendors) > 0): ?>
			<div class="left-red-block widget-title">Vendor Shortcuts</div>
			<ul id="vendors-shortcuts" class="cw-erpv-posts">
				<?php
					foreach ($featured_vendors as $vendor) {
						if ($vendor['featured']) {
				?>
				<li class="vendor-shortcut featured">
					<a href="<?= $vendor['link'] ?>" class="img">
						<img src="<?= $vendor['logo'] ?>" class="vendor-logo" alt="Ferre Sposa Bridal Boutique" scale="0" />
					</a>
					<a href="<?= $vendor['link'] ?>"><?= $vendor['title'] ?></a>
				</li>
				<?php
						}
					}
					
					foreach ($featured_vendors as $vendor) {
						//if ($vendor['type'] == 'free' || ($vendor['type'] == 'standard' && !$vendor['enabled'])) {
						if (!$vendor['featured'] && $vendor['type'] != 'shutdown') {
				?>
				<li class="vendor-shortcut">
					<a href="<?= $vendor['link'] ?>">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="title"><?= $vendor['title'] ?></span>
					</a>
				</li>
				<?php
						}
					}
					
					foreach ($featured_vendors as $vendor) {
						if ($vendor['type'] == 'shutdown') {
				?>
				<li class="vendor-shortcut">
					<a href="<?= $vendor['link'] ?>">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="title"><?= $vendor['title'] ?></span>
					</a>
				</li>
				<?php
						}
					}
				?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
	
	<!--<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fixer.js"></script>-->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.stickit.js"></script>
	<script type="text/javascript">
		jQuery(window).load(function() {
			var $mainContentBlock = $(".main-content-block");
			var $widgetsBlock = $(".widgets-block");
			var $container = $("#vendors-shortcuts-widget-container");
			var $block = $("#vendors-shortcuts-widget");

			var admin_bar_height = $("#wpadminbar").height();
			var top = 10 + admin_bar_height;

			function updateHeight() {
//				if ($featuredVendors.length > 0) {
					var height = $mainContentBlock.height() - $container.offset().top + 50;
					if ($block.height() < height)
					{
						$container.height(height);
					}
//				}
			}
			updateHeight();
return;
			$block.fixer({ gap: top, isFixed: function() { updateHeight(); }});
		});
	</script>
</div>
<?php get_footer(); ?>

