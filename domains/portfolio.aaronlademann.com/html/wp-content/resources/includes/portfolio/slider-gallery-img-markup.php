<?php

	$args = array( 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'numberposts' => null, 'post_parent' => $post->ID );

	$attachments = get_posts($args);
	$i = 0;
	if ($attachments) {
		foreach ( $attachments as $attachment ) {
			$img_attr = wp_get_attachment_image_src( $attachment->ID , "full" );
			$img_src = $img_attr[0];
			$mime = get_mimetype($img_src);
			$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
			$image_title = $attachment->post_title;
			$caption = $attachment->post_excerpt;
			$description = $image->post_content;
?>
	<figure class="lightbox" id="<?php echo "folioImage-" . $i ?>">
		<img src="<?php echo $img_src; ?>" alt="<?php echo $caption; ?>" class="<?php echo $mime; ?>" />
		<figcaption class="caption">
			<p><?php echo $caption; ?></p>
		</figcaption>
	</figure>
<?php 
			$i++;
		} // END foreach
	} // end if($attachments) 
?>