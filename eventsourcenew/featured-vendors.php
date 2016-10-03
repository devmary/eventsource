<?php
require_once('vendors-func.php');

$featured_vendors = get_vendors_data($post->ID);

$featured_vendors_exists = FALSE;
		
foreach ($featured_vendors as $vendor) {
	if ($vendor['featured']) {
		$featured_vendors_exists = TRUE;
		break;
	}
}

if ($featured_vendors_exists === TRUE):
?>

<div class="featured-vendors">
	<div class="featured-vendors-title left-red-block col-xs-12"><?php $featured_vendor_single ? _e('Featured Vendors in this Article') : _e('Featured Vendors') ?></div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="featured-vendors-carousel">
			<?php
			
			foreach ($featured_vendors as $vendor) {
				if (!$vendor['featured']) {
					continue;
				}
				?>

				<div class="featured-vendor col-md-4 col-sm-4">
					<div class="header"><?= $vendor['category'] ?></div>
					<div class="thumb carousel slide" id="myCarousel<?php echo get_the_ID().'-'.$vendor['id'];?>" data-ride="carousel" data-interval="false">
						<div class="carousel-inner" role="listbox">
							<?php if ($vendor['images'] != null) foreach ($vendor['images'] as $image) { ?>
							<div class="item" style="background-image: url('<?= $image ?>')"></div>
							<?php } ?>
						</div>
						<?php if ($vendor['images'] != null && count($vendor['images']) > 1) { ?>
						<a class="left carousel-control" href="#myCarousel<?php echo get_the_ID().'-'.$vendor['id'];?>" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel<?php echo get_the_ID().'-'.$vendor['id'];?>" role="button" data-slide="next">
							<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<?php } ?>
					</div>
					<div class="description">
						<div class="featured-post-title"><a href="<?= $vendor['link'] ?>"><?php echo $vendor['title']; ?></a></div>
						<div class="featured-post-reviews clearfix">
							<a href="<?= $vendor['link'] . '/reviews' ?>">
								<div class="stars-block">
									<div class="stars" style="width: <?= $vendor['averageRating'] * 20 ?>%;"></div>
								</div>
								<div class="reviews-count">(<?= $vendor['reviewsCount'] ?>)</div>
							</a>
							<a href="<?= $vendor['link'] . '/blog-mentions' ?>">
								<div class="text"><?= $vendor['blogMentionsCountText'] ?></div>
							</a>
							<div class="clearfix"></div>
							<div class="btn-block">
								<div class="reb-btn"><a href="<?= $vendor['link'] ?>">PORTFOLIO</a></div>
								<div class="grey-btn btn-vendor-contact" data-id="<?= $vendor['id'] ?>">CONTACT</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

    <!-- Vendor Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModal" aria-hidden="true" data-backdrop="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <a class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>

                <div class="modal-header">

                	<div class="modal-email-thumb">
						<img src="img/details/modal-email-thumb.jpg" alt="" class="img-responsive">
					</div>

					<div class="modal-email-title">
						<h1><span>1 Burlington Convention Center</span></h1>
					</div>

                </div>

                <div class="modal-body">
	
					<form class="vendor-mail-form" data-toggle="validator">

						<div class="form-group">
							<input type="text" class="form-control" id="email-name" placeholder="Name" data-error="Enter Your Name" required>
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<input type="email" class="form-control" id="email-address" placeholder="Email Address" data-error="Enter Your Address" required>
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" id="email-phone" placeholder="Phone Number" data-error="Enter Your Phone Number" required>
							<div class="help-block with-errors"></div>
						</div>

						<div class="btn-group" role="group">
							<button type="button" class="btn btn-question btn-active">Ask a Question</button>
							<button type="button" class="btn btn-callback">Request a Callback</button>
							<button type="button" class="btn btn-package">Request Info Package</button>
						</div>

						<div class="form-group">
							<textarea class="form-control" id="email-message" placeholder="Please Enter Your Message Here" data-error="Enter Message" required></textarea>
						</div>

						<p class="label-checkbox"><input type="checkbox" id="deliver-copy"><label for="deliver-copy">Deliver a Copy of this Email to my Inbox</label></p>
						
						<button type="submit" class="btn btn-red">Send Message</button>

					</form>

					<div class="modal-similar-venues hidden-xs">

						<h4>Send to similar venues</h4>

						<div class="modal-similar-venues-list">

							<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb1.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-1"><label for="send-to-vendor-1">Send to this vendor too</label></p>
					      		</div>

					      	</div>

					      	<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb2.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-2"><label for="send-to-vendor-2">Send to this vendor too</label></p>
					      		</div>

					      	</div>

					      	<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb3.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-3"><label for="send-to-vendor-3">Send to this vendor too</label></p>
					      		</div>

					      	</div>

					      	<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb4.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-4"><label for="send-to-vendor-4">Send to this vendor too</label></p>
					      		</div>

					      	</div>

					      	<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb1.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-5"><label for="send-to-vendor-5">Send to this vendor too</label></p>
					      		</div>

					      	</div>

					      	<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb2.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-6"><label for="send-to-vendor-6">Send to this vendor too</label></p>
					      		</div>

					      	</div>

					      	<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb3.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-7"><label for="send-to-vendor-7">Send to this vendor too</label></p>
					      		</div>

					      	</div>

					      	<div class="modal-similar-venues-item">

								<div class="modal-similar-venues-thumb">
									<img src="img/details/em-thumb4.jpg" width="70" alt="">
								</div>

					      		<div class="modal-similar-venues-content">
				          			<h5>1 Burlington Convention Center &amp; Spa</h5>
				          			<p class="label-checkbox"><input type="checkbox" id="send-to-vendor-8"><label for="send-to-vendor-8">Send to this vendor too</label></p>
					      		</div>

					      	</div>

				      	</div>

				      	<p><a class="select-all-vendors">Select all vendors</a></p>

					</div>
					
                </div>

                <div class="modal-footer">

                	<p>EventSource.ca respects your Internet privacy. To ensure a prompt response, please type in your email address carefully.
						Use of contact forms for commercial solicitation is strictly prohibited [8.8.8.8].</p>

				</div>

            </div>

        </div>

    </div><!-- /.vendor-email-modal -->

<?php endif; ?>

<?php

if ($featured_vendor_single) {
	?>

	<div class="vendors-names">
		<? foreach ($featured_vendors as $vendor) {
			/*if ($vendor['enabled'] || $vendor['type'] == 'free') {*/
				?><span><?= $vendor['category'] ?>: <a href="<?= $vendor['link'] ?>"><?= $vendor['title'] ?></a></span><?
			/*}*/
		} ?>
	</div>

	<?php
}