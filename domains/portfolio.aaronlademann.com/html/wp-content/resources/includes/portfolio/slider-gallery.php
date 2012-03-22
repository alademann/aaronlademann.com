<?php 
  $image1 = get_post_meta(get_the_ID(), 'tz_portfolio_image', TRUE); 
		if($image1 != ''){
			$image1_caption = image_meta($image1,'caption', 'full');
			$image1_mime = image_meta($image1,'mime', 'full');
		}
  $image2 = get_post_meta(get_the_ID(), 'tz_portfolio_image2', TRUE); 
		if($image2 != ''){
			$image2_caption = image_meta($image2,'caption', 'full'); 
			$image2_mime = image_meta($image2,'mime', 'full');
		}
  $image3 = get_post_meta(get_the_ID(), 'tz_portfolio_image3', TRUE); 
		if($image3 != ''){
			$image3_caption = image_meta($image3,'caption', 'full');
			$image3_mime = image_meta($image3,'mime', 'full');
		}
  $image4 = get_post_meta(get_the_ID(), 'tz_portfolio_image4', TRUE); 
		if($image4 != ''){
			$image4_caption = image_meta($image4,'caption', 'full');
			$image4_mime = image_meta($image4,'mime', 'full');
		}
  $image5 = get_post_meta(get_the_ID(), 'tz_portfolio_image5', TRUE);
		if($image5 != ''){
			$image5_caption = image_meta($image5,'caption', 'full'); 
			$image5_mime = image_meta($image5,'mime', 'full');
		}
  $image6 = get_post_meta(get_the_ID(), 'tz_portfolio_image6', TRUE); 
		if($image6 != ''){
			$image6_caption = image_meta($image6,'caption', 'full');
			$image6_mime = image_meta($image6,'mime', 'full');
		}
  $image7 = get_post_meta(get_the_ID(), 'tz_portfolio_image7', TRUE); 
		if($image7 != ''){
			$image7_caption = image_meta($image7,'caption', 'full'); 
			$image7_mime = image_meta($image7,'mime', 'full');
		}
  $image8 = get_post_meta(get_the_ID(), 'tz_portfolio_image8', TRUE); 
		if($image8 != ''){
			$image8_caption = image_meta($image8,'caption', 'full');
			$image8_mime = image_meta($image8,'mime', 'full');
		}
  $image9 = get_post_meta(get_the_ID(), 'tz_portfolio_image9', TRUE); 
		if($image9 != ''){
			$image9_caption = image_meta($image9,'caption', 'full');
			$image9_mime = image_meta($image9,'mime', 'full');
		}
  $image10 = get_post_meta(get_the_ID(), 'tz_portfolio_image10', TRUE);
		if($image10 != ''){
			$image10_caption = image_meta($image10,'caption', 'full'); 
			$image10_mime = image_meta($image10,'mime', 'full');
		}
	$image11 = get_post_meta(get_the_ID(), 'tz_portfolio_image11', TRUE);
		if($image11 != ''){
			$image11_caption = image_meta($image11,'caption', 'full'); 
			$image11_mime = image_meta($image11,'mime', 'full');
		}
	$image12 = get_post_meta(get_the_ID(), 'tz_portfolio_image12', TRUE);
		if($image12 != ''){
			$image12_caption = image_meta($image12,'caption', 'full'); 
			$image12_mime = image_meta($image12,'mime', 'full');
		}
	$image13 = get_post_meta(get_the_ID(), 'tz_portfolio_image13', TRUE);
		if($image13 != ''){
			$image13_caption = image_meta($image13,'caption', 'full'); 
			$image13_mime = image_meta($image13,'mime', 'full');
		}
	$image14 = get_post_meta(get_the_ID(), 'tz_portfolio_image14', TRUE);
		if($image14 != ''){
			$image14_caption = image_meta($image14,'caption', 'full'); 
			$image14_mime = image_meta($image14,'mime', 'full');
		}
	$image15 = get_post_meta(get_the_ID(), 'tz_portfolio_image15', TRUE);
		if($image15 != ''){
			$image15_caption = image_meta($image15,'caption', 'full'); 
			$image15_mime = image_meta($image15,'mime', 'full');
		}

  $embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
  $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', false, '' );
	$thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
	$lightbox = TRUE;
	$height = get_post_meta(get_the_ID(), 'tz_portfolio_image_height', TRUE);

?>