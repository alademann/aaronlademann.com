<?php 

// echo the public directory where all the dynamic sass, template images, etc... are compiled
function public_uri(){
	return "/public";
}

function is_ios($browserAsString){

  if (strstr($browserAsString, " AppleWebKit/") && strstr($browserAsString, " Mobile/")) { 
		return true;
	} else {
		return false;
	}
	
}
function is_folio_home(){
	$home_page = home_url() . "/";
	$protocol = ($_SERVER['HTTPS'] ? "https" : "http") . "://";
	$curr_page = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	if($curr_page == $home_page) {
	 return true;
	}
}
/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-----------------------------------------------------------------------------------*/

/**
 * This theme uses wp_nav_menu() in two locations.
 */
register_nav_menus( array(
	'primary' => __( 'Header Menu', 'gridlocked' ),
	'secondary' => __( 'Footer Menu', 'gridlocked' ),
) ); 

/*-----------------------------------------------------------------------------------*/
/*	Exclude pages from search
/*-----------------------------------------------------------------------------------*/


function tz_exclude_pages($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
//add_filter('pre_get_posts','tz_exclude_pages');


/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain ('framework');


/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="seperator clearfix"><div class="line"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="seperator clearfix"><div class="line"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Portfolio Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="seperator clearfix"><div class="line"></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Overlay Column 1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Overlay Column 2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Overlay Column 3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Overlay Column 4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}


/*-----------------------------------------------------------------------------------*/
/*	Post Formats
/*-----------------------------------------------------------------------------------*/

$formats = array( 
			'aside', 
			'gallery', 
			'link', 
			'image', 
			'quote', 
			'audio',
			'video');

add_theme_support( 'post-formats', $formats ); 

add_post_type_support( 'post', 'post-formats' );


/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
	//add_image_size( 'large', 680, '', true ); // Large thumbnails
	//add_image_size( 'medium', 250, '', true ); // Medium thumbnails
	//add_image_size( 'small', 125, '', true ); // Small thumbnails
	//add_image_size( 'archive-thumb', 360, '', true ); // Thumbnails that appear on any archive like page
	//add_image_size( 'single-thumb', 550, '', true ); // Thumbnails that appear on any single page
	//add_image_size( 'thumbnail', 230, 170, true ); // Thumbnails that appear on any single page
	//add_image_size( 'gallery-format-thumb', 360, 270, true ); // Thumbnails that appear on gallery formats
	//add_image_size( 'fullsize', '', '', true ); // Fullsize
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/

function tz_custom_gravatar( $avatar_defaults ) {
    $tz_avatar = get_template_directory_uri() . '/images/gravatar.png';
    $avatar_defaults[$tz_avatar] = 'Custom Gravatar (/images/gravatar.png)';
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'tz_custom_gravatar' );


/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

function tz_excerpt_length($length) {
return 17; }
add_filter('excerpt_length', 'tz_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

function tz_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'tz_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*	Register and load common JS
/*-----------------------------------------------------------------------------------*/

function tz_register_js(){
	if(!is_admin()){
		wp_deregister_script('jquery');
	}
}
add_action('init', 'tz_register_js');
/* REPLACED WITH head.js calls in FOOTER.PHP
function tz_register_js() {
	if (!is_admin()) {
		
		wp_register_script('tz_custom', get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', TRUE); 
		wp_register_script('jquery-ui-custom', get_template_directory_uri() . '/js/jquery-ui-1.8.5.custom.min.js', 'jquery', '1.0', TRUE);
		wp_register_script('jquery-cookie', get_template_directory_uri() . '/js/carhartl-jquery-cookie/jquery.cookie.js', 'jquery', '1.0', TRUE);
		wp_register_script('jquery-animate-colors', get_template_directory_uri() . '/js/jquery.animate-colors.js', 'jquery', '1.0', TRUE);
		wp_register_script('tz_shortcodes', get_template_directory_uri() . '/js/jquery.shortcodes.js', 'jquery', '1.0', TRUE); 
		wp_register_script('custom-javascript', '/wp-content/resources/custom-javascript.js', 'jquery', '1.0', TRUE);	 	
		wp_register_script('head-min', get_template_directory_uri() . '/js/head.min.js');	 

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-custom');
		wp_enqueue_script('jquery-cookie');
		wp_enqueue_script('custom-javascript');
		wp_enqueue_script('jquery-animate-colors');
		wp_enqueue_script('tz_shortcodes');
			$browserAsString = $_SERVER['HTTP_USER_AGENT'];
			if (strstr($browserAsString, " AppleWebKit/") && strstr($browserAsString, " Mobile/")) { 
					wp_register_script('iOS', get_template_directory_uri() . '/js/iOSfixedPosition.js', 'jquery', '1.0', TRUE);
					wp_enqueue_script( 'iOS' );
			}
		wp_enqueue_script('tz_custom');
		wp_enqueue_script('head-min');

	}
}
add_action('init', 'tz_register_js');
*/

/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

function tz_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_register_script('tz-admin', get_template_directory_uri() . '/js/jquery.custom.admin.js', 'jquery');
		wp_enqueue_script('tz-admin');
	}
}
add_action('admin_enqueue_scripts','tz_admin_js',10,1);


/*-----------------------------------------------------------------------------------*/
/*	Load contact template javascript
/*-----------------------------------------------------------------------------------*/

function tz_contact_js() {
	if (is_page_template('template-contact.php') ) 
		wp_register_script('validation', 'http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js', 'jquery');
		wp_enqueue_script('validation');
}
add_action('wp_print_scripts', 'tz_contact_js');


/*-----------------------------------------------------------------------------------*/
/* Load scripts for single pages
/*-----------------------------------------------------------------------------------*/

/* REPLACED WITH head.js calls in FOOTER.PHP
function tz_single_scripts() {
	
	if(is_singular()) 
		
		wp_register_script('easing', get_template_directory_uri().'/js/jquery.easing.1.3.js', 'jquery', '1.0', TRUE);
		//wp_enqueue_script( 'comment-reply' );
		wp_enqueue_script( 'easing' );
		
	if(is_singular() && has_post_format('image'))
	
		wp_register_script('fancybox', get_template_directory_uri().'/js/jquery.fancybox-1.3.4.pack.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script( 'fancybox' );
		
	if(is_singular() && has_post_format('gallery') || get_post_type() == 'portfolio')
	
		wp_register_script('slidesjs', get_template_directory_uri().'/js/slides.min.jquery.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script( 'slidesjs' );
		
		wp_register_script('jPlayer', get_template_directory_uri().'/js/jquery.jplayer.min.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script( 'jPlayer' );
		
	if(is_singular() && has_post_format('video') || has_post_format('audio') )
	
		wp_register_script('jPlayer', get_template_directory_uri().'/js/jquery.jplayer.min.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script( 'jPlayer' );
		
	
}
add_action('wp_print_scripts', 'tz_single_scripts');
*/

/*-----------------------------------------------------------------------------------*/
/*	Scripts for blog pages
/*-----------------------------------------------------------------------------------*/

/* REPLACED WITH head.js calls in FOOTER.PHP
function tz_non_singular_scripts() {
	if(!is_singular())
	
		wp_register_script('slidesjs', get_template_directory_uri().'/js/slides.min.jquery.js', 'jquery', '1.0', TRUE);
		wp_register_script('masonry', get_template_directory_uri().'/js/jquery.masonry.min.js', 'jquery', '1.0', TRUE);
		wp_register_script('fancybox', get_template_directory_uri().'/js/jquery.fancybox-1.3.4.pack.js', 'jquery', '1.0', TRUE);
		wp_register_script('easing', get_template_directory_uri().'/js/jquery.easing.1.3.js', 'jquery', '1.0', TRUE);
		wp_register_script('jPlayer', get_template_directory_uri().'/js/jquery.jplayer.min.js', 'jquery', '1.0', TRUE);
		
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'slidesjs' );
		wp_enqueue_script( 'fancybox' );
		wp_enqueue_script( 'jPlayer' );
		wp_enqueue_script( 'easing' );
		//wp_enqueue_script( 'masonry' );

		
}
add_action('wp_print_scripts', 'tz_non_singular_scripts');
*/

/*-----------------------------------------------------------------------------------*/
/*	Load stylesheets if needed
/*-----------------------------------------------------------------------------------*/

function tz_styles() {
	// aaronl: custom
	//	wp_register_style( 'fancybox', get_template_directory_uri() . '/css/fancybox/jquery.fancybox-1.3.4.css' );
	//	wp_enqueue_style( 'fancybox' );
		
}
add_action('wp_print_styles', 'tz_styles');

/*-----------------------------------------------------------------------------------*/
/*	Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','tz_browser_body_class');
function tz_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	
	$classes[] = 'aafolio';
	return $classes;
}


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function tz_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
     <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
     
      <?php echo get_avatar($comment,$size='35'); ?>
      
      <div class="comment-author vcard">
         <?php printf(__('%s'), get_comment_author_link()) ?> 
		 <?php if($isByAuthor) { ?><span class="author-tag"><?php _e('(Author)','framework') ?></span><?php } ?>
      </div>

      <div class="comment-meta commentmetadata">
	  	<?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
		<?php edit_comment_link(__('(Edit)'),'  ','') ?> &middot; 
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      
      <div class="comment-inner">
      
	  	<?php if ($comment->comment_approved == '0') : ?>
         <em class="moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      	<?php endif; ?>
  
   		<?php comment_text() ?>
        
      </div>
      
     </div>

<?php
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

function tz_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }


/*-----------------------------------------------------------------------------------*/
/*	Custom Login Logo Support
/*-----------------------------------------------------------------------------------*/

function tz_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/custom-login-logo.png) !important; }
    </style>';
}
function tz_wp_login_url() {
echo home_url();
}
function tz_wp_login_title() {
echo get_option('blogname');
}

add_action('login_head', 'tz_custom_login_logo');
add_filter('login_headerurl', 'tz_wp_login_url');
add_filter('login_headertitle', 'tz_wp_login_title');


/*-----------------------------------------------------------------------------------*/
/*	Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/

// Add the Theme Shortcodes
include("functions/theme-shortcodes.php");

// Add the Flickr Widget
include("functions/widget-flickr.php");

// Add the Twitter Widget
include("functions/widget-tweets.php");

// Add the tinymce button
include("functions/tinymce/tinymce.php");

// Add the post meta
include("functions/theme-postmeta.php");

// Add the portfolio meta
include("functions/theme-portfoliometa.php");

// Add the post types
include("functions/theme-posttypes.php");

// Add the post types
include("functions/theme-likethis.php");


/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Load Theme Options
/*-----------------------------------------------------------------------------------*/

define('TZ_FILEPATH', TEMPLATEPATH);
define('TZ_DIRECTORY', get_template_directory_uri());

require_once (TZ_FILEPATH . '/admin/admin-functions.php');
require_once (TZ_FILEPATH . '/admin/admin-interface.php');
require_once (TZ_FILEPATH . '/admin/theme-options.php');
require_once (TZ_FILEPATH . '/admin/theme-functions.php');

?>
<?php // get taxonomies terms links
function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
			$return = join( ', ', $out );
		}
		return $return;
	}
} ?>
<?php

/* Taxonomy Breadcrumb */
function be_taxonomy_breadcrumb() {
// Get the current term
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

// Create a list of all the term's parents
$parent = $term->parent;
while ($parent):
$parents[] = $parent;
$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
$parent = $new_parent->parent;
endwhile;
if(!empty($parents)):
$parents = array_reverse($parents);

// For each parent, create a breadcrumb item
foreach ($parents as $parent):
$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
$item_tax = $item->taxonomy;
$parent_slug;

switch ($item_tax)  
{    
    case __( 'skill-type' ):  
        $parent_slug = 'portfolio/skill';
        break;
		case __( 'portfolio-type' ):  
        $parent_slug = 'portfolio/type';
        break;
		case __( 'media-type' ):  
        $parent_slug = 'portfolio/media';
        break;
		case __( 'project' ):  
        $parent_slug = 'portfolio/client';
        break;
		case __( 'tools-used' ):  
        $parent_slug = 'portfolio/tool';
        break;

}  

$url = get_bloginfo('url').'/'.$parent_slug.'/'.$item->slug;
echo '<li><a href="'.$url.'/">'.$item->name.'</a></li>';
endforeach;
endif;

// Display the current term in the breadcrumb
echo '<li><h1>'.$term->name.'</h1></li>';
}


function tz_taxonomy_crumbs(){
	echo '<ul class="breadcrumb"><li><a href="http://aaronlademann.com/">Home</a></li><li><a href="/">Portfolio</a></li>';
	echo be_taxonomy_breadcrumb();
	echo '</ul>';
}

function get_attachment_id_from_src($image_src) {

	global $wpdb;
	$query = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid = '$image_src'" ) );
	$id = $query->ID;

	//$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	//$id = $wpdb->get_var($query);
	
	if($id == null){
      $image_src = basename ( $image_src );
      $q2 = "SELECT post_id FROM {$wpdb->postmeta}  WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE '%$image_src%'";
      $id = $wpdb->get_var($q2);
  }

	return $id;


}

function image_meta($image_src,$meta_key,$size) {

	// size is optional when calling this function... we'll set the default here.
	if(!$size || $size == ''){
		$this_size = 'full';
	} else {
		$this_size = $size;
	}
	$img_id = get_attachment_id_from_src($image_src);
	$img_size = wp_get_attachment_image_src($image_src, $this_size);
	$image = get_post($img_id);
	$meta = '';

  switch($meta_key)
  {
		case 'caption':
			$meta = $image->post_excerpt;
			break;
		case 'content':
			$meta = $image->post_content;
			break;
		case 'title':
			$meta = $image->post_title;
			break;
	  case 'alt':
			$meta = get_post_meta($img_id, '_wp_attachment_image_alt', true);
			break;
		case 'width':
			$meta = $img_size[1];
			break;
		case 'height':
			$meta = $img_size[2];
			break;
		case 'mime':
			$meta = substr($image->post_mime_type, strrpos($image->post_mime_type,"/") + 1);
			break;
		default:
		// the meta they are looking for is a custom field
			custom_meta($image_src,$meta_key);
			break;
	}

	return htmlspecialchars($meta, ENT_QUOTES);

}

function custom_meta($image_src,$meta_key){
	
	// for getting custom field data
  $meta = wp_get_attachment_metadata(get_attachment_id_from_src($image_src));
	if($meta){
		foreach($meta['image_meta'] as $key => $value){
			if($key == $meta_key){
				return $key . ': ' . $value;
			}
		}
		return $meta;
	} else {
		//something went wrong here.
		return 'no such value exists for key: "' . $meta_key . '"';
	}

}

?>