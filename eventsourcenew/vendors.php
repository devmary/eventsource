<?php

require_once('vendors_func.php');

if (!function_exists ('link')) {
	function link($link) {
		if ($link && strpos($link, 'http') !== 0 && $link[0] != '/') {
			$link = 'http://' . $link;
		}
		
		return $link;
	}
}

$vendors = get_vendors($post->ID);
$vendors_count = count($vendors);

if ($vendors_count > 0) {
?>
	<div class="vendors-links" style="padding:0;" id="vendorLinks">
<?php
    $i = 0;
    foreach ($vendors as $vendor) {
?>
		<span class="vendor-link"><?php echo $vendor['category']; ?>:
<?php
	if ($vendor['vendor_link']) {
?>
	<a href="<?php echo link($vendor['vendor_link']); ?>" target="_blank"><?php echo stripslashes($vendor['title']) ?></a>
<?php
	}
	else {
		echo stripslashes($vendor['title']);
	}
?>
		</span>
<?php
		
		if ($i < $vendors_count - 1) {
			echo ' | ';
		}

        $i++;
	} ?>
    
	</div>
<?php
}
?>
	
<?php

$featured_vendors_exists = FALSE;

foreach ($vendors as $v) {
	if ($v['featured']) {
		$featured_vendors_exists = TRUE;
		break;
	}
}
?>
	<div class="featured_vendors">
<?php
if ($featured_vendors_exists === TRUE) {
?>
		<h2 class="blog_header">Featured Vendors In This Article</h2><br/>
<?php
	foreach ($vendors as $vendor) {
	
		if (!$vendor['featured']) {
			continue;
		}
?>

	<a href="<?php echo $vendor['link'] ?>" class="vendor-info">
		<div class="box_portfolio">
			<div class="text">
				<h3><?php echo $vendor['title'] ?></h3>
				<span class="btn">VIEW PROFILE </span>
			</div>
			<div class="vendor-logo-box">
				<img src="<?php echo $vendor['image'] ?>?width=95&height=95&mode=crop" class="vendor-logo" alt="<?php echo $vendor['title'] ?>">
			</div>
		</div>
		<div class="clear"></div>
	</a>
<?php
	}
}
?>
	</div><!--.featured_vendors -->