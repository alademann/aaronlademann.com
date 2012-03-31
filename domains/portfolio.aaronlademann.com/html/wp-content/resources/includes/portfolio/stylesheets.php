<?php
if(getBrowser(browser) == 'IE' && getBrowser(majorver) == 6) { ?>
<!-- Internet Explorer 6 -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie_6.css">
<?php
} elseif(getBrowser(browser) == 'IE' && getBrowser(majorver) == 7) { ?>
<!-- Internet Explorer 7 -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie_7.css">
<?php
} elseif(getBrowser(browser) == 'IE' && getBrowser(majorver) == 8) { ?>
<!-- Internet Explorer 8 -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie_8.css">
<?php
} elseif(getBrowser(browser) == 'IE' && getBrowser(majorver) > 8) { ?>
<!-- Internet Explorer 9+ -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie_gt8.css">
<?php
} elseif(getBrowser(browser) == 'IE' && getBrowser(majorver) < 6) { ?>
<!-- Internet Explorer 5 Or Lower (UNSUPPORTED) -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie_6.css">
<?php
} elseif(getBrowser(browser) != 'IE') { ?>
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/screen.css">				
<?php
}?>
<?php if(getBrowser(browser) == 'IE') { ?>
<!-- Internet Explorer -->
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie.css">
<?php } ?>

<noscript><link rel="stylesheet" href="<?php echo public_uri(); ?>/css/noscript.css"></noscript>
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/print.css" media="print">