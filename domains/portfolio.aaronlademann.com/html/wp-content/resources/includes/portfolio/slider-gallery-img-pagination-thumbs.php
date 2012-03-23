<ul class="pagination thumbs">
<?php
	$args = array( 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'numberposts' => null, 'post_parent' => $post->ID );

	$attachments = get_posts($args);
	if ($attachments) {
		foreach ( $attachments as $attachment ) {
			$thumb_attr = wp_get_attachment_image_src( $attachment->ID , "post-thumbnail" );
			$thumb_src = $thumb_attr[0];
			$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
			$image_title = $attachment->post_title;
			$caption = $attachment->post_excerpt;
			$description = $image->post_content;
?>
	<li><a title="Click to view full-size <?php echo $caption; ?>" href="#"><img src="<?php echo $thumb_src; ?>" alt="<?php echo $caption; ?> Thumbnail"></a></li>
<?php } } ?>
</ul>