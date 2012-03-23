<header id="masthead" class="navbar navbar-fixed-top">
	<section class="navbar-inner">
		<section class="container-fluid">
		<!-- TOP NAV -->
			
			<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      <!-- Be sure to leave the brand out there if you want it shown -->
			<?php if(is_folio_home()) { ?><h1><?php } ?>
      <a class="brand" href="<?php echo site_url(); ?>">Portfolio</a>
			<?php if(is_folio_home()) { ?></h1><?php } ?>
      <!-- Everything you want hidden at 940px or less, place within here -->
			<nav class="nav-collapse">
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#skills" class="dropdown-toggle" data-toggle="dropdown">Skills<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php wp_nav_menu(array(
								'theme_location'	=> 'skills', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#type" class="dropdown-toggle" data-toggle="dropdown">Work Type<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php wp_nav_menu(array(
								'theme_location'	=> 'type', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#client" class="dropdown-toggle" data-toggle="dropdown">Client<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php wp_nav_menu(array(
								'theme_location'	=> 'client', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#media" class="dropdown-toggle" data-toggle="dropdown">Media Type<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php wp_nav_menu(array(
								'theme_location'	=> 'media', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#tools" class="dropdown-toggle" data-toggle="dropdown">Tools Used<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php wp_nav_menu(array(
								'theme_location'	=> 'tools', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
						</ul>
					</li>

					<li class="divider-vertical"></li>

					<!-- primary nav -->
					<?php wp_nav_menu(array(
						'theme_location'	=> 'primary', 
						'container'				=> '',
						'items_wrap'      => '%3$s',
						)); 
					?>
				</ul>
			</nav>


			<!--<section id="logoContainer">
				<a id="mastlogo" href="<?php echo site_url(); ?>" title="AaronLademann.com" rel="nofollow">
					<img src="<?php echo site_url(); ?>/public/images/masthead-aaronlademann.com-logo.png" width="294" height="52" alt="<?php echo bloginfo( 'name' ) ?>" />
				</a>  
			</section>-->
		<!-- END TOP NAV -->
		</section>    
	</section>
</header>