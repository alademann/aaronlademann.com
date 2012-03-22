<script id="image_raw_sources">
		// break down all the different sizes i have for each shot
		<?php if($image1 != '') : ?>raw_src1 = "<?php echo $image1; ?>";<?php endif; ?>
		<?php if($image2 != '') : ?>raw_src2 = "<?php echo $image2; ?>";<?php endif; ?>
		<?php if($image3 != '') : ?>raw_src3 = "<?php echo $image3; ?>";<?php endif; ?>
		<?php if($image4 != '') : ?>raw_src4 = "<?php echo $image4; ?>";<?php endif; ?>
		<?php if($image5 != '') : ?>raw_src5 = "<?php echo $image5; ?>";<?php endif; ?>
		<?php if($image6 != '') : ?>raw_src6 = "<?php echo $image6; ?>";<?php endif; ?>
		<?php if($image7 != '') : ?>raw_src7 = "<?php echo $image7; ?>";<?php endif; ?>
		<?php if($image8 != '') : ?>raw_src8 = "<?php echo $image8; ?>";<?php endif; ?>
		<?php if($image9 != '') : ?>raw_src9 = "<?php echo $image9; ?>";<?php endif; ?>
		<?php if($image10 != '') : ?>raw_src10 = "<?php echo $image10; ?>";<?php endif; ?>
		<?php if($image11 != '') : ?>raw_src11 = "<?php echo $image11; ?>";<?php endif; ?>
		<?php if($image12 != '') : ?>raw_src12 = "<?php echo $image12; ?>";<?php endif; ?>
		<?php if($image13 != '') : ?>raw_src13 = "<?php echo $image13; ?>";<?php endif; ?>
		<?php if($image14 != '') : ?>raw_src14 = "<?php echo $image14; ?>";<?php endif; ?>
		<?php if($image15 != '') : ?>raw_src15 = "<?php echo $image15; ?>";<?php endif; ?>

		function get_image_src(index,size){
			// break down the raw src info pieces
			var raw_src;
			var img_size;
			//console.info("index: " + index);
			switch(index)
			{
				case '1':
					raw_src = raw_src1;		
				break;
				case '2':
					raw_src = raw_src2;
				break;
				case '3':
					raw_src = raw_src3;
				break;
				case '4':
					raw_src = raw_src4;
				break;
				case '5':
					raw_src = raw_src5;
				break;
				case '6':
					raw_src = raw_src6;
				break;
				case '7':
					raw_src = raw_src7;
				break;
				case '8':
					raw_src = raw_src8;
				break;
				case '9':
					raw_src = raw_src9;
				break;
				case '10':
					raw_src = raw_src10;
				break;
				case '11':
					raw_src = raw_src11;
				break;
				case '12':
					raw_src = raw_src12;
				break;
				case '13':
					raw_src = raw_src13;
				break;
				case '14':
					raw_src = raw_src14;
				break;
				case '15':
					raw_src = raw_src15;
				break;
				default:
				// something went wrong
				//console.warn("no index " + index + " is defined here.");
			} 
			var img_suffix = "-";
			var img_scaled = "-med."; // if there is a larger version of the image, this will show up at the end of the filename
			var img_dir =  raw_src.slice(0,raw_src.lastIndexOf("/") + 1);
			var img_mime = raw_src.slice(raw_src.lastIndexOf("."),raw_src.length);
			var img_name = '';
			if( raw_src.lastIndexOf(img_scaled) != -1 ){
				//console.info(raw_src.lastIndexOf(img_scaled));
				img_name = raw_src.slice(raw_src.lastIndexOf("/") + 1,raw_src.lastIndexOf(img_suffix));	
			} else {
				//console.info("else " + raw_src.lastIndexOf(img_scaled));
				img_name = raw_src.slice(raw_src.lastIndexOf("/") + 1,raw_src.lastIndexOf(img_mime));  	
			}
			var image;

			if(size == "full"){
				image = img_dir + img_name + img_mime; // original uploaded file... no suffix / size added to filename
			} else {
				image = img_dir + img_name + img_suffix + size + img_mime;	
			}
			//console.info("raw_src: " + raw_src + "\nimage: " + image);
			return image;
										
		}
									
		head.ready(function(){
			var $ = jQuery.noConflict();					
			var win_width = $(window).width();
			var large_image_size;
			if(win_width > 1024) {
				if(win_width > 1200) {
					large_image_size = 'full';
				} else {
					large_image_size = 'lg';
				}
			} else {
				large_image_size = 'med';
			}
			var lightImages = $(".slider").find("a.lightbox");
			$(lightImages).each(function(index){
				var strIndex = (index + 1)+'';
				var lightLink;

				var scaled_image = $(this).find("img").attr("src");
				if( scaled_image.lastIndexOf("-med") ){
					lightLink = get_image_src(strIndex,large_image_size);
				} else {
					lightLink = get_image_src(strIndex,"full");
				}

				$(this).attr("href",lightLink);
				//console.info("link #1 href=" + lightLink);
											
			});
		});
</script>
<?php 
	function get_rawsrc($uri){
		$length = strlen($uri);
		$period_pos = strrpos($uri,".");
			
		$is_medium = strrpos($uri,"-med");
		if($is_medium){
			$raw_src = substr($uri, 0, $period_pos - 4);	
		} else {
			$raw_src = substr($uri, 0, $period_pos);
		}

			return $raw_src;

	} // END get_rawsrc
	function get_fullsize($uri){
		$length = strlen($uri);
		$period_pos = strrpos($uri,".");
			
		$mime = substr($uri,$period_pos,($length-$period_pos));
		$raw_src = get_rawsrc($uri);
			
		return $raw_src . $mime;		

	} // END get_fullsize
	function get_thumbsize($uri){
		$length = strlen($uri);
		$period_pos = strrpos($uri,".");

		$mime = substr($uri,$period_pos,($length-$period_pos));
		$raw_src = get_rawsrc($uri);

		return $raw_src . "-thumb_sm" . $mime;
	}
?>