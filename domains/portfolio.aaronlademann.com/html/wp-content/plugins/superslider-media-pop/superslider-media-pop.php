<?php
/*
Plugin Name: SuperSlider-Media-Pop
Description: Soda pop for your media. Adds numerous image related controls and options to your media admin panels. Adds image sizes to the image link buttons and insert image in the insert image screen.
Plugin URI: http://superslider.daivmowbray.com/superslider/superslider-media-pop/
Author: Daiv Mowbray
Author URI: http://www.daivmowbray.com
Version: 1.6.1
*/

/*
Acknowledgments:
the change post attachment feature is based on:
Change Attachment Parent, by Joel Sholdice :http://lacquerhead.ca/2009/07/change-attachment-parent/

the mass edit image properties is based on:
Faster Image Insert, by David Frank :http://blog.ticktag.org/2009/02/19/2765/
*/


/*
Edit the following variables to set basic options
*/

$ss_set_jpeg_quality = 1; // set to 0 to turn jpeg quality control off

/*
edit to here
*/


add_action ( 'admin_init', 'init_media_pop');
add_action ( 'admin_init', 'media_pop_create_media_page');

    function init_media_pop() {
        
        global $ss_set_jpeg_quality;
             
        add_filter ( 'plugin_action_links_' . plugin_basename(__FILE__), 'filter_plugin_pop', 10, 2 );
        
        add_filter ( 'attachment_fields_to_edit', 'ss_attach_image', 10, 2);
        add_filter ( 'attachment_fields_to_save', 'ss_update_attach_parent', 11, 2);
  
        add_filter( 'manage_posts_columns', 'ss_add_post_page_columns' );
        add_filter( 'manage_pages_columns', 'ss_add_post_page_columns' );
        
        add_action( 'manage_posts_custom_column', 'ss_add_id_value', 10, 2);
        add_action( 'manage_posts_custom_column', 'ss_add_thumb_value', 2, 2 );
        add_action( 'manage_posts_custom_column', 'ss_add_attachment_value', 10, 2);

        add_action( 'manage_pages_custom_column', 'ss_add_id_value', 10, 2);
        add_action( 'manage_pages_custom_column', 'ss_add_thumb_value', 2, 2 );	
        add_action( 'manage_pages_custom_column', 'ss_add_attachment_value', 10, 2);
        
      // add columns to media page
      if (strpos($_SERVER["REQUEST_URI"], "wp-admin/upload.php") !== FALSE) {
        add_filter( 'manage_media_columns', 'ss_add_media_columns' );
         add_action( 'manage_media_custom_column', 'ss_add_media_values', 10, 2);
        add_action('admin_head', 'ss_media_column_css');
        
       } 
       if (strpos($_SERVER["REQUEST_URI"], "wp-admin/options-media.php") !== FALSE) {
        add_action('admin_head', 'ss_options_css');
       }
      if (strpos($_SERVER["REQUEST_URI"], "wp-admin/edit.php") !== FALSE || strpos($_SERVER["REQUEST_URI"], "wp-admin/media-upload.php") !== FALSE || strpos($_SERVER["REQUEST_URI"], "wp-admin/edit-pages.php") !== FALSE)  {
         add_action('admin_head', 'ss_media_column_css');
      }
     
      if ( $ss_set_jpeg_quality == 1) {
            add_filter( 'jpeg_quality', 'ss_pop_jpeg_quality', 10, 2 );
      }
      
      
      set_post_thumbnail_size( get_option ('post_thumbnail_width'), get_option ('post_thumbnail_height'), get_option ('post_thumbnail_crop') );
      
            // Only activate these for the Media Library page
     if (strpos($_SERVER["REQUEST_URI"], "wp-admin/media-upload.php") !== FALSE) {
        add_filter ( 'attachment_fields_to_edit', 'ss_add_pop_sizes', 10, 2);
        add_filter ( 'attachment_fields_to_edit', 'ss_add_image_sizes', 11, 2);
        add_action ( 'admin_head', 'ss_insert_mass_edit');
        add_filter ( 'media_upload_gallery', 'ss_insert_media_all_selected');
      }   
      
    /*  $add_tax_columns = get_option ('add_tax_columns');
      if($add_tax_columns == 1){
        $tax_names = get_taxonomies();
        $tax_names = array_slice($tax_names, 4);
        foreach ( $tax_names as $tax ) {
            add_filter( 'manage_posts_columns', 'ss_add_tax_column', 10, 1 );
            add_action( 'manage_posts_custom_column', 'ss_add_tax_value', 10, 3  );
        }
        }*/
    
    }
    /*function ss_tax_columns(){
        $add_tax_columns = get_option ('add_tax_columns');
        if( $add_tax_columns == 1)  $check = 'checked = "checked"';        
        echo '<input type="checkbox" name="add_tax_columns" id="add_tax_columns" value="1" class="checkbox" '.$check.' />
        <label for="add_tax_columns">'.__('add taxonomy columns', 'superslider-image-pop').'</label>';
        
    }

	function ss_add_tax_value($column_name, $post_id) { 
       $tax_names = get_taxonomies();
        $tax_names = array_slice($tax_names, 4);	
	   foreach ( $tax_names as $tax ) {  
           if ( $tax == $column_name ) {
                $tax = get_the_term_list( $post_id, $tax, '{' , '|' , '}' );             
                if ( is_wp_error( $tax ) ) return false;               
                echo apply_filters('the_terms', $tax, $tax);     
            }
	    }
	}

    function ss_add_tax_column($cols) {
        $tax_names = get_taxonomies();
        $tax_names = array_slice($tax_names, 4);
        foreach ( $tax_names as $tax ) { 
            if ( is_wp_error( $tax ) ) return false; 
            $col = array($tax => $tax );        
		    return $cols = ss_insert($cols, '8', $col);
		}
	}

    */
    function ss_post_thumbnail_size(){
       $width = get_option ('post_thumbnail_width');
       $height = get_option ('post_thumbnail_height');
       $crop = get_option ('post_thumbnail_crop');
        set_post_thumbnail_size($width, $height, $crop);
    }
    function media_pop_create_media_page() {    			
        register_setting( 'media', 'ss_admin_thumb' );
        register_setting( 'media', 'jpeg_quality' );
        register_setting( 'media', 'image_default_link_type' );
        register_setting( 'media', 'image_default_align' );
        register_setting( 'media', 'image_default_size' );
        
        register_setting( 'media', 'post_thumbnail_width' );
        register_setting( 'media', 'post_thumbnail_height' );
        register_setting( 'media', 'post_thumbnail_crop' );
        
        //register_setting( 'media', 'add_tax_columns' );
        
        add_settings_section( 'media-pop', 'SuperSlider-Media-Pop ', 'media_pop_section', 'media');			
        add_settings_field( 'jpeg_quality', 'Image compression', 'ss_jpeg_quality', 'media', 'media-pop');
        add_settings_field( 'ss_admin_thumb', 'Admin post list thumbnail', 'ss_admin_thumb', 'media', 'media-pop');
        add_settings_field( 'image_default_link_type', 'Default attached links to ', 'ss_attach_link', 'media', 'media-pop');
        add_settings_field( 'image_default_align', 'Default image alignment ', 'ss_attach_align', 'media', 'media-pop');
        add_settings_field( 'image_default_size', 'Default image size ', 'ss_attach_size', 'media', 'media-pop');
        
        //add_settings_field( 'add_tax_columns', 'Add taxonomy columns to post list ', 'ss_tax_columns', 'media', 'media-pop');
  
        global $_wp_theme_features;
        if($_wp_theme_features['post-thumbnails'])
        add_settings_field( 'post_thumbnail', 'Post Thumbnail', 'ss_post_thumbnail', 'media', 'default');
        
    }
    function ss_options_css(){
       echo '<style type="text/css">
        .align {
        display:inline;
        font-weight:bold;
        margin:0 6px 0 2px;
        padding:0 0 0 22px;
        font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
        font-size:13px;
        text-transform: capitalize;}
        .image-align-none-label {
            background: url(images/align-none.png) no-repeat center left;}        
        .image-align-left-label {
            background: url(images/align-left.png) no-repeat center left;}        
        .image-align-center-label {
            background: url(images/align-center.png) no-repeat center left;}       
        .image-align-right-label {
            background: url(images/align-right.png) no-repeat center left;}
        </style>';
    }
    
    function media_pop_section() { 
       $section = '<span class="description"> '.__('Set default options for various image properties.', 'superslider-media-pop').'</span>';        
       echo $section;
    }
    
    function filter_plugin_pop($links) {
			$settings_link = '<a href="options-media.php">'.__('Settings').'</a>';
			array_unshift( $links, $settings_link ); //  before other links
			return $links;
    }
    function ss_post_thumbnail() { 
        $width = get_option ('post_thumbnail_width');
        $height = get_option ('post_thumbnail_height');
        $crop = get_option ('post_thumbnail_crop');

        echo '<label for="post_thumbnail_width">'.__(' Max Width ', 'superslider-image-pop').'</label>
        <input name="post_thumbnail_width" id="post_thumbnail_width" type="text" value="'.$width.'" class="small-text" />
        <label for="post_thumbnail_height">'.__(' Max Height ', 'superslider-image-pop').'</label>
        <input name="post_thumbnail_height" id="post_thumbnail_height" type="text" value="'.$height.'" class="small-text" />'; 

        if( $crop == 1)$check = 'checked = "checked"';        
        echo '<br /><input type="checkbox" name="post_thumbnail_crop" id="post_thumbnail_crop" value="1" class="checkbox" '.$check.' />
        <label for="post_thumbnail_crop">'.__('Crop post thumbnail to exact dimensions', 'superslider-image-pop').'</label>';
                
	}
	
	function ss_jpeg_quality() { 
        $jpeg = get_option ('jpeg_quality');
        echo '<label for="jpeg_quality">'.__('jpeg image quality', 'superslider-image-pop').'</label>
        <input name="jpeg_quality" id="jpeg_quality" type="text" value="'. $jpeg.'" class="small-text" />'; 
	}
    
    function ss_admin_thumb() { 
        $thumb = get_option ('ss_admin_thumb');
        echo '<label for="ss_admin_thumb">'.__('Post list thumbnail display size', 'superslider-image-pop').'</label>
        <input name="ss_admin_thumb" id="ss_admin_thumb" type="text" value="'. $thumb.'" class="small-text" /> px'; 

	}
	
	function ss_attach_size() { 	    
        $dsize = get_option ('image_default_size');
        $check = 'checked = "checked"';
        $size_names = ss_all_image_sizes();        
        echo '<div style="width:440px;margin:10px 0px; padding:10px 4px; border: 1px solid #cdcdcd;">';
        
        foreach ( $size_names as $size ) {        
            $check = '';
            if($dsize == $size) $check = ' checked = "checked" ';
            echo '<input type="radio" '.$check.' value="'.$size.'" id="image-size-'.$align.'" name="image_default_size"><label style="margin: 0px 8px 0px 4px;" class="image-size-'.$size.'-label" for="image-size-'.$size.'">'.$size.'</label>';  
         $count++;
         if($count == 4 || $count == 8) echo "<br />";
         }
         echo "</div>";
	}
	
	function ss_attach_align() { 
        $alignOption = get_option ('image_default_align');
        $check = 'checked = "checked"';
        $alignSet = array(
            0 => 'none',
            1 => 'left',
            2 => 'center',
            3 => 'right',
        );
        foreach ( $alignSet as $align ) {
            $check = '';
            if($alignOption == $align) $check = ' checked = "checked" ';
            echo '<input type="radio" '.$check.' value="'.$align.'" id="image-align-'.$align.'" name="image_default_align"><label style="margin: 0px 8px 0px 4px;" class="align image-align-'.$align.'-label" for="image-align-'.$align.'">'.$align.'</label>';  
         }

	}
	function ss_attach_link() { 
        $attach_link = get_option('image_default_link_type');
        $size_names = ss_all_image_sizes();
       
        $check = '';
        if($attach_link == 'none') $check = ' checked = "checked" ';        
        echo '<div style="width:440px;margin:10px 0px; padding:10px 4px; border: 1px solid #cdcdcd;"><input type="radio" name="image_default_link_type" id="ss_attach_none" value="none" '.$check.' />';
        echo '<label for="ss_attach_none" class="radio" style="margin: 0px 8px 0px 4px;">'.__('none', 'superslider-image-pop').'</label>';
        
        foreach ( $size_names as $size ) {
            $check = '';
            if($attach_link == $size) $check = ' checked = "checked" ';            
            echo '<input type="radio" name="image_default_link_type" id="ss_attach_'.$size.'" value="'.$size.'" '.$check.' />';
            echo '<label for="ss_attach_'.$size.'" class="radio" style="margin: 0px 8px 0px 4px;">'.$size.'</label>'; 
            $count++;
            if($count == 4 || $count == 8) echo "<br />";
        }
        $check = '';
        if($attach_link == 'post') $check = ' checked = "checked" ';        
        echo '<input type="radio" name="image_default_link_type" id="ss_attach_post" value="post" '.$check.' />';
        echo '<label for="ss_attach_post" class="radio" style="margin: 0px 8px 0px 4px;">'.__('attach page', 'superslider-image-pop').'</label></div>';
	}
	
    function ss_pop_jpeg_quality(  ) { 
        $image_quality = get_option('jpeg_quality');
        if (!$image_quality) $image_quality =  90;
        return $image_quality; // WP system Default is 90
    }
    
    function ss_insert($array = '', $position = '' , $elements= '') {                   
        $left = array_slice ($array, 0, $position-1);
        $right = array_slice ($array, $position-1);
        $array = array_merge ($left, $elements, $right);
        return $array;
    } 
    
    /*
    * Media Library columns
    * media-upload.php
    */
    function ss_media_column_css() {
        $style='<style type="text/css">
        .column-media { width:100px!important;}
        .column-author { width:70px!important;}
        .column-thumbnail { width:90px!important;}
        .column-thumbnail img, .media-icon img{ padding: 2px;border:1px solid #cdcdcd;}
        .column-title { width:100px!important;}
        .column-parent { width:100px!important;}
        .column-caption { width:80px!important;}
        .column-alt-text { width:70px!important;}
        .column-description { width:120px!important;}
        .column-attachments { width:170px!important;}
        .attach-thumb {float:left;margin:2px 4px 4px 0px;padding:2px;border:1px solid #cdcdcd;}
        .attach-text {border-bottom:1px solid silver;float:left;}
        .column-attachments img { max-width:30px!important; max-height:30px!important;}
        .column-id { width:40px!important;}
        #mass-edit .title{border-bottom:1px solid #DADADA;
            clear:both;
            font-size:1.6em;
            padding:0 0 3px;
            color:#5A5A5A;
            font-family:Georgia,"Times New Roman",Times,serif;
            font-weight:normal;}
        .att_list_limit {padding: 2px;border:1px solid #cdcdcd;}
        .att_list_head {padding: 2px 4px;background: #eaeaea;margin:-2px -2px 2px -2px;}
        .ss-mini {
        	color: gray;
        	font-size: 8px;
        	font-weight: normal;}
        </style>';
               
        echo $style;        
    }

    /*
    * Media columns
    */
    function ss_add_media_columns($cols) {
      /*  $capt = array('caption'=>__('Caption', 'superslider-media-pop'));
        $cols = ss_insert($cols, '4', $capt);*/
        $capt = array('caption'=>__('Caption', 'superslider-media-pop'));
        $cols = ss_insert($cols, '4', $capt);
        $media_id = array('id'=>__('ID', 'superslider-media-pop'));
        //$cols = ss_insert($cols, '11', $id);
        $cols['id'] = __('ID', 'superslider-media-pop');
        $alt = array('alt-text'=>__('Alternate', 'superslider-media-pop'));
        $cols = ss_insert($cols, '5', $alt);
        $descript = array('description'=>__('Description', 'superslider-media-pop'));
     
        return $cols = ss_insert($cols, '4', $descript); 
 

 }    

    function ss_add_media_values($column_name, $post_id) {    
        switch($column_name):            
            case 'caption':
                $att = get_post($att_id);  
                echo $att->post_excerpt;
            break;
            case 'description':
                $desc = get_post($att_id);  
                echo $desc->post_content;
            break;
            case 'alt-text':
                $image_alt = get_post_meta($post_id, '_wp_attachment_image_alt', true);
                echo $image_alt;
            break;
            case 'id':
                echo $post_id;
            break;
        endswitch;
    }
    
    
    /*
    * Post - Page columns
    */
    function ss_add_post_page_columns($cols) {
        $thumb = array('thumbnail'=>__('Thumbnail', 'superslider-media-pop'));
        $cols = ss_insert($cols, '2', $thumb);
        $cols['attachments'] = __('Attachments', 'superslider-media-pop');
        $id = array('id'=>__('ID', 'superslider-media-pop'));
         
        // plugin file gallery is here (http://wordpress.org/extend/plugins/file-gallery/)
         if ($cols['post_thumb']) {
            unset($cols['post_thumb']);
            unset($cols['attachment_count']);
        }

		return $cols = ss_insert($cols, '3', $id);
	}

	function ss_add_thumb_value($column_name, $post_id) {           
           $thumb_size = get_option ('ss_admin_thumb');
 
			if ( 'thumbnail' == $column_name ) {
				// thumbnail of WP 2.9
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
								
				if ($thumbnail_id) {
					$thumb = "<a href='".get_edit_post_link($post_id)."' >";
//wp_get_attachment_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '')
					$thumb .= wp_get_attachment_image( $thumbnail_id, '', true, 'class="max-width:'.$thumb_size.';"' );
				    $thumb .= "</a><br/><span class=''>".__('featured image', 'superslider-media-pop')."</span>";
				}
				else {	
				    $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'DESC') );

					foreach ( $attachments as $attachment_id => $attachment ) {
					    $thumb = "<a href='".get_edit_post_link($post_id)."' >";
						$thumb .= wp_get_attachment_image( $attachment_id, array($thumb_size, $thumb_size), true );
						$thumb .= "</a><br/><span class=''>".__('attached image', 'superslider-media-pop')."</span>";
					}
				}				
                if ( isset($thumb) && $thumb ) {
                    echo $thumb;
                } else {
                    echo "<a href='upload.php?detached=1' title='".__('First take note of the post ID and title', 'superslider-media-pop')."'>".__('Add image', 'superslider-media-pop')."</a>";
                }
			}
	}
	
    function ss_add_attachment_value($column_name, $post_id) {
        global $wpdb;
        if( $column_name == 'attachments' ) {
            $query = "SELECT post_title, ID FROM $wpdb->posts ".
                     "WHERE post_type='attachment' ".
                     "AND post_parent='$post_id' ".
                     "ORDER BY menu_order ASC LIMIT 31";
            $attachments = $wpdb->get_results($query);
            $att_count = count($attachments);
            if( $att_count >= 30) $limit = '<br style="clear:both;" /><div class="subsubsub">'.__('More than 30 attached.', 'superslider-media-pop').'</div>';
            if( $attachments ) {

                $my_func = create_function('$att',
                    '$title =  substr($att->post_title, 0, 14); 
                    if ( strlen($att->post_title) > 14) $title .= " ... ";
                    $thumb = wp_get_attachment_image( $att->ID, array(30, 30), true, array("class"=>"pinkynail") );
                    return "<div class=\"attach-thumb\">".$thumb."</div><div class=\"attach-text\"><span>".$title.
                    " </span><br /><a href=\"".get_permalink($att->ID)."\" title=\"".__(View )." ".$att->post_title."\">".
                    __(View).
                    "</a> | <a href=\"media.php?attachment_id=".$att->ID."&action=edit\" title=\"".__(Edit )." ".$att->post_title."\">".
                    __(Edit).
                    "</a></div>";');
                    
               if( $att_count >= 5) { 
                    $att_count = '<span>' .  $att_count . __(' attachments', 'superslider-media-pop') .'</span>';
                    $open = '<div class="att_list_limit"><div class="att_list_head">'.$att_count.'</div>'; 
                    $close = '<br style="clear:both;"/></div>';
                    }                    
               $text = array_map($my_func, $attachments);              
               $att_list = $open . implode('<br style="clear:both;"/>',$text) . $close . $limit;
               
               echo $att_list;
               
            } else {
                echo '<i>'.__('None attached', 'superslider-media-pop').'</i><br /><a href="upload.php" title="'.__('First take note of the post ID and title', 'superslider-media-pop').'">'.__('Attach', 'superslider-media-pop').'</a>';
                // would be good to have a link to the media lib
                //<br /><a class="hide-if-no-js" onclick="findPosts.open(\'media[]\',\''. $post_id .'\');return false;" href="#the-list">'. __('Attach', 'superslider-media-pop').'</a>'
            }
        }
    }
	function ss_add_id_value($column_name, $post_id) { 
        if ( 'id' == $column_name ) {
                echo $post_id;                
        }
	}
    /*
    * Upload form enhancments
    */
    function ss_add_pop_sizes($form_fields, $post){       
        if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
            $form_fields['url'] = array(
			'label'      => __('Link URL', 'superslider-media-pop'),
			'input'      => 'html',
			'html'       => ss_pop_size_input_buttons($post, get_option('image_default_link_type')) );
        }   
     return $form_fields;
    }
    
    function ss_pop_size_input_buttons($post, $url_type = '') {
        $file = wp_get_attachment_url($post->ID);
        $link = get_attachment_link($post->ID);
        $size_names = ss_all_image_sizes();

        $size = get_option ('image_default_link_type');
        if ($size != 'none') {
            $image = wp_get_attachment_image_src($post->ID, $size);
            $url = $image[0];
        } else { $url = ''; }
        
        $out[] = '<div style="width:460px;margin: 10px 0px; padding:10px 4px; border: 1px solid #cdcdcd;">';
		$out[] = "<input type='text' class='text urlfield' name='attachments[$post->ID][url]' value='" . esc_attr($url) . "' style='margin-bottom: 10px;' /><br />";
		$out[] = "<button type='button' class='button urlnone' title=''>" . __('Don\'t<br />link', 'superslider-media-pop') . "</button>";
		
		foreach ( $size_names as $size ) {
			$downsize = image_downsize($post->ID, $size);
			$enabled = ( $downsize[3] || 'full' == $size );
            $image = wp_get_attachment_image_src($post->ID, $size);
            
			$html = "<button type='button' title='" . esc_attr($image[0]) . "' class='button urlfile' " . ss_disabled( $enabled, false, false ) . " />";

			$html .= $size."<br />";
			if ( $enabled ) {
				$html .=  sprintf( "(%d&nbsp;&times;&nbsp;%d)", $downsize[1], $downsize[2] );
			} else {
			    $html .=  __('Not available', 'superslider-media-pop' );
			}

			$html .= "</button>";
			$out[] = $html;
		}
        $out[] = "<button type='button' class='button urlpost' title='" . esc_attr($link) . "'>" . __('Attachment <br />page url', 'superslider-media-pop') . "</button></div>";
        
        return  join("\n", $out);
    }
    
    
    /*
    * This adds the attach to post field
    */
    function ss_attach_image($form_fields, $post){        
       // if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
            $form_fields['post_parent'] = array(
			'label'      => __('Attach to Post', 'superslider-media-pop'),
			'value'      => $post->post_parent,
			'helps'      => __('To detach this file, set the post # to 0. Or enter a different post #.', 'superslider-media-pop'),
			'input'      => 'html',
			'html'       => ss_attach_image_input($post, get_option('image_default_link_type')) );
       // }   
     return $form_fields;
    }
    
    function ss_attach_image_input($post) {
           
        $out[] = '<div style="width:460px;margin: 10px 0px; padding:10px 4px; border: 1px solid #cdcdcd; width:450px;">';
        $out[] = '<span style="margin: 4px;">'.__('This file is attached to post # ','superslider-media-pop').'</span>';
        $out[] = '<input type="text" value="'.$post->post_parent.'" name="attachments['.$post->ID.'][post_parent]" id="attachments['.$post->ID.'][post_parent]" class="text" style="width: 80px;">';
		//$out[] = '<a href="#the-list" onclick="findPosts.open(\'media[]\',\''.$post->ID.'\');return false;" class="hide-if-no-js">'.__(' Attach to post ..', 'superslider-media-pop').'</a>';
        $out[] = '</div>';
       
        return  join("\n", $out);
    }

    function ss_insert_mass_edit(){
        
        $size_names = ss_all_image_sizes();   
        $mass_out[] = '<div style="width:460px; margin: 10px 0px; padding:10px 4px; border: 1px solid #cdcdcd;">';            
        foreach ( $size_names as $size ) {            
            $html = '<div style="float:left;width:48%;"><input type="radio" name="size_edit" id="size_'.$size.'" value="'.$size.'" /><label for="size_'.$size.'" style="padding:0px 4px 2px 8px;" >';
            $html .= $size."</label></div>";
            $mass_out[] = $html;
        }    
        $mass_out[] = '<br style="clear:both;" /></div>';            
        $images = join(" ", $mass_out);
        
        global $wp_version;
        if (version_compare($wp_version, '2.8.0', '>=')) $compat = true;
?>
<script type="text/javascript">
/* <![CDATA[ */

 jQuery(function($) {
 
<?php
  if( function_exists('faster_insert_local'))$fast_insert = 1;
  if(!$fast_insert) { //!$fast || 
?>
  
    $('#media-items .new').each(function(e) {
      var id = $(this).parent().attr('id');
      id = id.split("-")[2];
      $(this).prepend('<input type="checkbox" class="item_selection" title="<?php _e('Select items you want to insert','faster-image-insert'); ?>" id="attachments[' + id.substring() + '][selected]" name="attachments[' + id + '][selected]" value="selected" /> ');
    });

    //buttons for enhanced functions
    $('.ml-submit:first').append('<input type="submit" class="button savebutton" name="insertall" id="insertall" value="<?php echo attribute_escape( __( 'Insert selected images', 'superslider-media-pop') ); ?>" /> ');  
    $('.ml-submit:first').append('<input type="submit" class="button savebutton" name="invertall" id="invertall" value="<?php echo attribute_escape( __( 'Invert selection', 'superslider-media-pop') ); ?>" /> ');
<?php if(!$compat) { ?>
    if($('#media-search').length == 0) {
      $('.ml-submit:first').append('<input type="submit" class="button savebutton" name="orderreverse" id="orderreverse" value="<?php echo attribute_escape( __( 'Reversed ordering', 'superslider-media-pop') ); ?>" /> ');
    }
<?php } ?>
    $('.ml-submit:first').append('<input type="submit" class="button savebutton" name="expandall" id="expandall" value="<?php echo attribute_escape( __( 'Toggle items', 'superslider-media-pop') ); ?>" /> ');
    $('.ml-submit #invertall').click(
      function(){
        $('#media-items .item_selection').each(function(e) {
          if($(this).is(':checked')) $(this).attr("checked","");
          else $(this).attr("checked","checked");
        });
        return false;
      }
    );
    
    //500 should be enough for everyone :->
<?php if(!$compat) { ?>
    $('.ml-submit #orderreverse').click(
      function(){
        var i = 500;
        $('#media-items .menu_order_input').each(function(e) {
          $(this).val(i); i--;
        });
        return false;
      }
    );
<?php } ?>
    $('.ml-submit #expandall').click(
      function(){
        $('#media-items .media-item').each(function(e) {
          $(this).find(".describe-toggle-on").toggle();
          $(this).find(".describe-toggle-off").toggle();
          $(this).find(".slidetoggle").toggle();
        });
        return false;
      }
    ); 
 
<?php
} 
?>

    if($('#media-items').length > 0) {
      if($('#mass-edit').length > 0) { $('#mass-edit').remove(); };

     $('#gallery-form p.ml-submit:first').after('<div id="mass-edit"><div class="title"><?php _e('Mass Image Edit','superslider-media-pop'); ?> <span class="ss-mini">SuperSlider-Media-Pop</span></div></div>');

        var masstable = '' ;
        masstable += '<table id="basic" class="describe"><tbody><tr><th scope="row" class="label"><label><span class="alignleft">hello';
        masstable += "</span></label></th>";
        masstable += '<td class="field">';
        masstable += "</td></tr></tbody></table>";
        
        $('#mass-edit .title').after(masstable);
          
      $('#mass-edit .describe tr:eq(0)').clone().appendTo('#mass-edit .describe');
      $('#mass-edit .describe tr:eq(1)').clone().appendTo('#mass-edit .describe');     
      $('#mass-edit .describe tr:eq(2)').clone().appendTo('#mass-edit .describe');
      $('#mass-edit .describe tr:eq(3)').clone().appendTo('#mass-edit .describe');
      $('#mass-edit .describe tr:eq(4)').clone().appendTo('#mass-edit .describe');
      $('#mass-edit .describe tr:eq(5)').clone().appendTo('#mass-edit .describe');
      $('#mass-edit .describe tr:eq(6)').clone().appendTo('#mass-edit .describe');
      
      $('#mass-edit').append('<p class="ml-submit" style="padding-top: 3px;margin-top:0px;border-top:1px solid #dadada"><input type="button" class="button" name="massedit" id="massedit" value="<?php _e('Apply changes to all Selected','superslider-media-pop'); ?>" /> <br /><span><?php _e('Then press "Save all changes" to save Title/Captions/Description/Parent-ID to data base.','superslider-media-pop'); ?></span></p>');

      $('#mass-edit tr:eq(0) .alignleft').html('<?php _e('Image Titles:','superslider-media-pop'); ?>');
      $('#mass-edit tr:eq(1) .alignleft').html('<?php _e('Image Alt-Texts:','superslider-media-pop'); ?>'); 
      $('#mass-edit tr:eq(2) .alignleft').html('<?php _e('Image Captions:','superslider-media-pop'); ?>');      
      $('#mass-edit tr:eq(3) .alignleft').html('<?php _e('Image Descriptions:','superslider-media-pop'); ?>');
      $('#mass-edit tr:eq(4) .alignleft').html('<?php _e('Parent ID:','superslider-media-pop'); ?>');
      $('#mass-edit tr:eq(5) .alignleft').html('<?php _e('Image Alignment:','superslider-media-pop'); ?>');
      $('#mass-edit tr:eq(6) .alignleft').html('<?php _e('Link to:','superslider-media-pop'); ?>');
      $('#mass-edit tr:eq(7) .alignleft').html('<?php _e('Image Sizes:','superslider-media-pop'); ?>');
          
      $('#mass-edit tr:eq(0) .field').html('<input type="text" name="title_edit" id="title_edit" value="" />');
      $('#mass-edit tr:eq(1) .field').html('<input type="text" name="alt_edit" id="alt_edit" value="" />');
      $('#mass-edit tr:eq(2) .field').html('<input type="text" name="captn_edit" id="captn_edit" value="" />');     
      $('#mass-edit tr:eq(3) .field').html('<textarea type="text" name="descript_edit" id="descript_edit"></textarea>');
      $('#mass-edit tr:eq(4) .field').html('<input type="text" name="id_edit" id="id_edit" value="" />');
      $('#mass-edit tr:eq(5) .field').html('<input type="radio" name="align_edit" id="align_none" value="none" />\n<label for="align_none" class="radio"><?php _e('None') ?></label>\n<input type="radio" name="align_edit" id="align_left" value="left" />\n<label for="align_left" class="radio"><?php _e('Left') ?></label>\n<input type="radio" name="align_edit" id="align_center" value="center" />\n<label for="align_center" class="radio"><?php _e('Center') ?></label>\n<input type="radio" name="align_edit" id="align_right" value="right" />\n<label for="align_right" class="radio"><?php _e('Right') ?></label>');      
      $('#mass-edit tr:eq(6) .field').html('<input type="text" name="link_edit" id="link_edit" value="" /><br /><span><?php _e(' This attachment property does not save.','superslider-media-pop'); ?></span>');
      $('#mass-edit tr:eq(7) .field').html('<?php print $images;  ?>');
      
      $('#massedit').click(function() {
        var massedit = new Array();
        massedit[0] = $('#mass-edit .describe #title_edit').val();
        massedit[1] = $('#mass-edit .describe #alt_edit').val();
        massedit[2] = $('#mass-edit .describe #captn_edit').val();        
        massedit[3] = $('#mass-edit .describe #descript_edit').val();
        massedit[4] = $('#mass-edit .describe #id_edit').val();
        massedit[5] = $('#mass-edit tr:eq(5) .field input:checked').val();
        massedit[6] = $('#mass-edit .describe #link_edit').val();
        massedit[7] = $('#mass-edit tr:eq(7) .field input:checked').val();
        //alert('<?php _e('All selected media file forms have been updated to: ','superslider-media-pop'); ?>'+ massedit + '<?php _e(': Remember to press "Save All changes".','superslider-media-pop'); ?>');
       $('.media-item').each(function(e) {
       
       if( $(this).find('.filename :input').is(':checked')) {
       $(this).find('.pinkynail').hide();
       $(this).find('#sort-buttons span a').toggle();
	   $(this).find('a.describe-toggle-on').hide();
	   $(this).find('a.describe-toggle-off, table.slidetoggle').show();
	   
          if(typeof massedit[0] !== "undefined" && massedit[0].length > 0) $(this).find('.post_title .field input').val(massedit[0]);
          if(typeof massedit[1] !== "undefined" && massedit[1].length > 0) $(this).find('.image_alt .field input').val(massedit[1]);
          if(typeof massedit[2] !== "undefined" && massedit[2].length > 0) $(this).find('.post_excerpt .field input').val(massedit[2]);
          if(typeof massedit[3] !== "undefined" && massedit[3].length > 0) $(this).find('.post_content .field textarea').val(massedit[3]);
          if(typeof massedit[4] !== "undefined" && massedit[4].length > 0) $(this).find('.post_parent .field input').val(massedit[4]);
          if(typeof massedit[5] !== "undefined" && massedit[5].length > 0) {
            $(this).find('.align .field input[value='+massedit[5]+']').attr("checked","checked");
          }
          if(typeof massedit[6] !== "undefined" && massedit[6].length > 0) $(this).find('.url .field input').val(massedit[6]);
          if(typeof massedit[7] !== "undefined" && massedit[7].length > 0) {
            $(this).find('.image-size .field input[value='+massedit[7]+']').attr("checked","checked");
          }
         
        } 
         
        });
      });
    }
  });
/* ]]> */
</script>
<?php
    }
    
    //filter for media_upload_gallery, recognize insertall request.
    function ss_insert_media_all_selected() {
      if ( isset($_POST['insertall']) ) {
        $return = ss_insert_form_handler();
        
        if ( is_string($return) )
          return $return;
        if ( is_array($return) )
          $errors = $return;
      }
    }    
   
    
    //catches the insert all images post request.
    function ss_insert_form_handler() {
      global $post_ID, $temp_ID;
      $post_id = (int) (0 == $post_ID ? $temp_ID : $post_ID);
      check_admin_referer('media-form');
      
      $insert_cstring = '';
      $cstring_num = 1;
      $oneline = 0;
    
      if ( !empty($_POST['attachments']) ) {
        $result = '';

        foreach ( $_POST['attachments'] as $attachment_id => $attachment ) {
          $attachment = stripslashes_deep( $attachment );
          if (!empty($attachment['selected'])) {
            $html = $attachment['post_title'];
            if ( !empty($attachment['url']) ) {
              if ( strpos($attachment['url'], 'attachment_id') || false !== strpos($attachment['url'], get_permalink($post_id)) )
                $rel = " rel='attachment wp-att-".attribute_escape($attachment_id)."'";
              $html = "<a href='{$attachment['url']}'$rel>$html</a>";
            }
            $html = apply_filters('media_send_to_editor', $html, $attachment_id, $attachment);
            if(!$oneline) $result .= $html.str_repeat("\\n".$insert_cstring."\\n",$cstring_num);
            else $result .= $html.str_repeat($insert_cstring,$cstring_num);
          }
        }
        return ss_insert_to_editor($result);
      }    
      return $errors;
    }
    
    //used for passing content to edit panel.
    function ss_insert_to_editor($html) {
    ?>
    <script type="text/javascript">
    /* <![CDATA[ */
    var win = window.dialogArguments || opener || parent || top;
    win.send_to_editor('<?php echo str_replace('\\\n','\\n',addslashes($html)); ?>');
    /* ]]> */
    </script>
      <?php
      exit;
    }

    /*
    *   changes the parent of the attached file
    *   retuns post.
    */
    function ss_update_attach_parent($post, $attachment) {  
        
        $post_parent = esc_attr($_POST['attachments'][$post['post_parent']]);        
        if( $post_parent !== $attachment[post_parent] ){           
            $post[post_parent] = $attachment[post_parent];
        }
        return $post;    
    }
    
    function ss_add_image_sizes($form_fields, $post){
       unset ( $form_fields['image-size'] );
        if ( substr($post->post_mime_type, 0, 5) == 'image' ) {          
           $form_fields['image-size'] = pop_image_size_input_fields( $post, get_option('image_default_size', 'medium') );
        }
     return $form_fields;
    }
    
    function ss_disabled( $disabled, $current = true, $echo = true ) {	   
	   return __checked_selected_helper( $disabled, $current, $echo, 'disabled' );
    }
    
    function ss_all_image_sizes() {
        // get a list of the actual pixel dimensions of each possible intermediate version of this image
        global $wp_version;    
        // is not version 3+
         if (version_compare($wp_version, "2.9.9", "<")) {
            $size_names = array('thumbnail' => 'thumbnail', 'medium' => 'medium', 'large' => 'large', 'full' => 'full',);
            if (function_exists('add_theme_support')) $size_names['post-thumbnail'] = 'post-thumbnail'; 
            if (class_exists("ssShow")) { $size_names['slideshow'] = 'slideshow'; $size_names['minithumb'] = 'minithumb';}
            if (class_exists("ssExcerpt")) $size_names['excerpt'] = 'excerpt'; 
            if (class_exists("ssPnext")) $size_names['prenext'] = 'prenext'; 
    /*
    * This is where you'd add any other image sizes for pre WP 3.0
    */      
       } else {       
            $size_names =  get_intermediate_image_sizes();// this only works with WP version 3+
            $size_names[] = 'full'; // adds original / full sized image to list
       }
       return $size_names;
    }
    
    function pop_image_size_input_fields( $post, $check = '' ) {    
        $size_names = ss_all_image_sizes();        		
		if ( empty($check) )
			$check = get_user_setting('imgsize', 'medium');
			if($check == 'postthumbnail') $check = 'post-thumbnail';

        $out[] = '<div style="width:460px; margin: 10px 0px; padding:10px 4px; border: 1px solid #cdcdcd; ">';		
		foreach ( $size_names as $size ) {
		
			$downsize = image_downsize($post->ID, $size);
			$checked = '';            
			// is this size selectable?
			$enabled = ( $downsize[3] || 'full' == $size );

			$css_id = "image-size-{$size}-{$post->ID}";
			// if this size is the default but that's not available, don't select it
			if ( $size == $check ) {
				if ( $enabled )
					$checked = " checked='checked'";
				else
					$check = '';
			} elseif ( !$check && $enabled && 'thumbnail' != $size ) {
				// if $check is not enabled, default to the first available size that's bigger than a thumbnail
				$check = $size;
				$checked = " checked='checked'";
			}

			$html = "<div class='image-size-item' style='width: 30%; float:left;'><input type='radio' " . ss_disabled( $enabled, false, false ) . "name='attachments[$post->ID][image-size]' id='{$css_id}' value='{$size}'$checked /><br />";

			$html .= "<label for='{$css_id}'>$size <br />";
			// only show the dimensions if that choice is available
			if ( $enabled ) {
				$html .= " <label for='{$css_id}' class='help'>" . sprintf( "(%d&nbsp;&times;&nbsp;%d)", $downsize[1], $downsize[2] );
			} else {
			    $html .= " <label for='{$css_id}' class='help'>" . __('Not available', 'superslider-media-pop' );
			}

			$html .= '</label></div>';

			$out[] = $html;
		}
		
        $out[] = '<br style="clear:both;" /> </div>';
        
		return array(
			'label' => __('Image Size', 'superslider-media-pop'),
			'input' => 'html',
			'html'  => join("\n", $out),
		);
    }
?>