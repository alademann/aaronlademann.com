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
				<?php if (has_nav_menu( 'primary' )){ ?>
				<ul class="nav">	
					<?php
							wp_nav_menu(array(
							'theme_location'	=> 'primary', 
							'container'				=> '',
							'items_wrap'      => '%3$s',
							'depth'						=> 1 // don't want any dropdown situations here
							)); 
					?>
				</ul>
				<?php } ?>

				<?php if (
							has_nav_menu( 'media'		)		|| 
							has_nav_menu( 'skills'	)		|| 
							has_nav_menu( 'type'		)		|| 
							has_nav_menu( 'client'	)		|| 
							has_nav_menu( 'tools'		)
							)
				{ ?>
				<ul class="nav" id="taxonomy-browse">
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#browse" class="dropdown-toggle" data-toggle="dropdown">Browse<b class="caret"></b></a>
						<ul class="dropdown-menu" id="seperated-nav">
							<?php if (has_nav_menu( 'type' )){ ?>
							<li class="nav-header">Work Type</li>
							<?php wp_nav_menu(array(
								'theme_location'	=> 'type', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
							<li class="divider"></li>
							<?php } ?>
							<?php if (has_nav_menu( 'media' )){ ?>
							<li class="nav-header">Media Types</li>
							<?php wp_nav_menu(array(
									'theme_location'	=> 'media', 
									'container'				=> '',
									'items_wrap'      => '%3$s'
									)); 
							?>	
							<?php } ?>
							<?php if (has_nav_menu( 'skills' )){ ?>
							<li class="nav-header">Skills</li>
							<?php wp_nav_menu(array(
								'theme_location'	=> 'skills', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
							<li class="divider"></li>
							<?php } ?>
							<?php if (has_nav_menu( 'client' )){ ?>
							<li class="nav-header">Client Projects</li>
							<?php wp_nav_menu(array(
								'theme_location'	=> 'client', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
							<li class="divider"></li>
							<?php } ?>
							<?php if (has_nav_menu( 'tools' )){ ?>
							<li class="nav-header">Tools Used</li>
							<?php wp_nav_menu(array(
								'theme_location'	=> 'tools', 
								'container'				=> '',
								'items_wrap'      => '%3$s',
								)); 
							?>
							<li class="divider"></li>
							<?php } ?>
							
						</ul>
					</li>
				</ul>
				<?php } ?>

				<?php get_search_form( $echo ); ?>

				<?php if ((
							has_nav_menu( 'media'		)		|| 
							has_nav_menu( 'skills'	)		|| 
							has_nav_menu( 'type'		)		|| 
							has_nav_menu( 'client'	)		|| 
							has_nav_menu( 'tools'		)
							) && !has_nav_menu( 'browseTaxonomy' ))
				{ ?>
				<ul class="nav" id="taxonomy-dds">
					<?php if (has_nav_menu( 'media' )){ ?>
					<li class="dropdown">
						<a href="#media" class="dropdown-toggle" data-toggle="dropdown">Media<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php
									wp_nav_menu(array(
									'theme_location'	=> 'media', 
									'container'				=> '',
									'items_wrap'      => '%3$s'
									)); 
							?>
						</ul>
					</li>
					<?php } ?>
					<?php if (has_nav_menu( 'skills' )){ ?>
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
					<?php } ?>
					<?php if (has_nav_menu( 'type' )){ ?>
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
					<?php } ?>
					<?php if (has_nav_menu( 'client' )){ ?>
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
					<?php } ?>
					<?php if (has_nav_menu( 'tools' )){ ?>
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
					<?php } ?>
				</ul>
				<!-- end portfolio category / taxonomy menus -->
				<?php } ?>

				<?php if (has_nav_menu( 'secondary' )){ ?>
				<ul class="nav pull-right" id="secondary-nav">
					<li class="divider-vertical"></li>
					<!-- primary nav -->
					<?php wp_nav_menu(array(
						'theme_location'	=> 'secondary', 
						'container'				=> '',
						'items_wrap'      => '%3$s',
						)); 
					?>
				</ul>
				<?php } ?>
			</nav>
		<!-- END TOP NAV -->
		</section>    
	</section>
</header>