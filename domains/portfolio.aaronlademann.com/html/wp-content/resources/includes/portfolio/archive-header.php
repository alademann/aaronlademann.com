<?php if ( function_exists('yoast_breadcrumb') ) { ?>
	<header>
		<h1 class="<?php echo $taxType ?>"><?php wp_title(''); ?></h1>
		<nav><?php	yoast_breadcrumb('<ul class="breadcrumb"><li>','</li></ul>');
		} ?>
		</nav>
	</header>