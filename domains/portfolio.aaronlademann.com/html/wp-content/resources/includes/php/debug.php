<?php if($_GET['debug']){ ?>
<aside class="span12">
	<section class="inner">
		<section class="alert alert-info debug-alert">
			<a class="close" data-dismiss="alert">x</a>
			<h4 class='alert-heading'>Page Debug Info</h4>
			<?php
			if(!isset($checkBrowser)){
				$checkBrowser = $_GET['browser'];
			}
			if(!isset($checkOS)){
				$checkOS = $_GET['os'];
			}
			if($checkBrowser) { 
				echo "<strong>Browser: </strong>" . ($checkBrowser == 'all' ? implode(" ", getBrowser()) : getBrowser('browser')) . "<br />";
			} 
			if($checkOS) { 
				echo "<strong>OS: </strong>" . getBrowser('platform') . "<br />";	
			} 
			?>
		</section>
	</section>
</aside>
<?php } ?>