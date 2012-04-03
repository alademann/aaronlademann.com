<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/print.css" media="print">
<?php if(getBrowser(browser) != 'IE'){ ?>
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/a_screen.css">
<?php } 
	// END IF !IE
?>

<?php if(getBrowser(browser) == 'IE') 
{ ?>
	<?php if(getBrowser(majorver) <= 8) 
	{ ?>
<!-- Internet Explorer 6, 7 or 8 -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie_lte8.css">
	<?php 
	} // END IF IE6,7,8
	?>
	<?php if(getBrowser(majorver) > 8) 
	{ ?>
<!-- Internet Explorer 9+ -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie_gt8.css">
	<?php 
	} // END IF IE9+
	?>
<!-- Internet Explorer (global) -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie.css">
<?php 
} // END IF IE
?>
<noscript><link rel="stylesheet" href="<?php echo public_uri(); ?>/css/noscript.css"></noscript>