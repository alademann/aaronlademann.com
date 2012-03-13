<?php if(get_option('tz_widget_overlay') == 'true') : ?>
    <!-- #widget-overlay-container -->
    <section id="widget-overlay-container" style="display: none;">   
      <!-- #widget-overlay -->
      <aside id="widget-overlay">      
				<!-- #overlay-inner -->
				<section id="overlay-inner" class="clearfix">     
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 1') ) ?>
					</section>
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 2') ) ?>
					</section>
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 3') ) ?>
					</section>
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 4') ) ?>
					</section>          
				</section>
				<!--// #overlay-inner -->
      </aside>
			<!--// #widget-overlay -->          
      <nav id="overlay-open"><a href="#"><?php _e('Open Widget Area', 'framework'); ?></a></nav>   
    </section>
		<!--// #widget-overlay-container -->
    <?php endif; ?>