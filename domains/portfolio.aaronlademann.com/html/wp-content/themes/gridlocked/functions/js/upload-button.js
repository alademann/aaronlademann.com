function getParameterByName(name)
{
  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
  var regexS = "[\\?&]" + name + "=([^&#]*)";
  var regex = new RegExp(regexS);
  var results = regex.exec(window.location.search);
  if(results == null)
    return "";
  else
    return decodeURIComponent(results[1].replace(/\+/g, " "));
}

jQuery(document).ready(function() {

	// grab the post id so the images don't all get attached to post 1
	var media_upload_uri = 'media-upload.php?post_id=' + parseInt(getParameterByName('post')) + '&amp;type=image&amp;TB_iframe=true';

	jQuery('#tz_portfolio_thumb_button').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_thumb').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button2').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image2').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button3').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image3').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button4').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image4').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button5').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image5').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button6').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image6').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button7').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image7').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button8').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image8').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button9').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image9').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button10').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image10').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button11').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image11').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button12').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image12').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button13').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image13').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button14').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image14').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

	jQuery('#tz_portfolio_image_button15').click(function() {

		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html).attr('src');
			jQuery('#tz_portfolio_image15').val(imgurl);
			tb_remove();
		}


		tb_show('', media_upload_uri);
		return false;

	});

});
