<?php

function get_vendors_data($post_id) {
	$meta_vendors = get_post_meta($post_id, 'vendors_meta', true);
	
	if (!$meta_vendors) {
		$meta_vendors = array();
	}

	$listingIds = array();
	
	foreach($meta_vendors as $meta) {
		if ($meta['vendor_es_id']) {
			$listingIds[] = $meta['vendor_es_id'];
		}
	}

	$postData = array(
		'listingIds' => $listingIds
	);
	
	$ch = curl_init(ES_URL_BLOG_GET_LISTINGS);
	curl_setopt_array($ch, array(
		CURLOPT_POST => TRUE,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
		CURLOPT_POSTFIELDS => json_encode($postData)
	));

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
	if (ES_CLIENT_SIDE_LOGIN) {
		curl_setopt($ch, CURLOPT_USERPWD, ES_CLIENT_SIDE_LOGIN.':'.ES_CLIENT_SIDE_PASS);
	}
	
	
	$response = curl_exec($ch);
	$d = json_decode($response, true);
	$es_vendors = json_decode($d['d'], true);
	
	if (!$es_vendors) {
		$es_vendors = array();
	}
	
	$vendors = array();

	foreach ($meta_vendors as $vendor) {
		//$vendor = $meta_vendors[$i];
		$es_vendor = NULL;

		if ($vendor['vendor_es_id']) {
			foreach ($es_vendors as $v) {
				if ($v['id'] == $vendor['vendor_es_id']) {
					$es_vendor = $v;
					break;
				}
			}
		}

		$es_enabled = false;
		$vendor_link = NULL;
		$logo = NULL;

		if ($es_vendor) {
			$es_enabled = $es_vendor['enabled'];
			$vendor_link = $es_enabled ? ('/website.aspx?id=' . $es_vendor['id']) : $es_vendor['homepage'];
			$logo = $es_vendor['logo'];
			
			if (!$image) {
				$image = $logo;
			}
		}
		else {
			$vendor_link = $vendor['vendor_link'];
		}

		$vendors[] = array(
			'id' => $vendor['vendor_es_id'],
			'vendor_link' => $vendor_link,
			'link' => $es_vendor ? $es_vendor['link'] : $vendor['vendor_link'],
			'title' => $es_vendor ? $es_vendor['label'] : $vendor['vendor_name'],
			'logo' => $logo,
			'image' => $es_vendor ? $es_vendor['image'] : $vendor['vendor_es_logo'],
			'email' => $es_vendor ? $es_vendor['email'] : $vendor['vendor_email'],
			'enabled' => $es_enabled,
			'featured' => $es_enabled && $es_vendor['type'] == 'standard',
			'type' => $es_vendor['type'],
			'category' => $vendor['vendor_category'],
			'es_category' => $es_vendor['category'],
			'blogMentionsCount' => $es_vendor ? $es_vendor['blogMentionsCount'] : '',
			'blogMentionsCountText' => $es_vendor ? $es_vendor['blogMentionsCountText'] : '',
			'totalRating' => $es_vendor ? $es_vendor['totalRating'] : '',
			'reviewsCount' => $es_vendor ? $es_vendor['reviewsCount'] : '',
			'googleRating' => $es_vendor ? $es_vendor['googleRating'] : '',
			'averageRating' => $es_vendor ? $es_vendor['averageRating'] : '',
			'images' => $es_vendor ? $es_vendor['images'] : null
		);
	}
	
	return $vendors;
}
