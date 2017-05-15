		</div>
	</div>
	</main>
		<footer class="mastfooter">
		    <div class="c">
		        <div class="footer-inner">
		           <div class="frow gutters">
			            <div class="col-md-1-3">
			            <?php
			            	if( is_active_sidebar( 'footer-widget-area-1' ) ) :
						        dynamic_sidebar( 'footer-widget-area-1' );
						    endif;
					    ?>
			            </div>
			            <div class="col-md-1-3">
			                <?php
				            	if( is_active_sidebar( 'footer-widget-area-2' ) ) :
							        dynamic_sidebar( 'footer-widget-area-2' );
							    endif;
						    ?>
			            </div>
			            <div class="col-md-1-3">
			                <?php
				            	if( is_active_sidebar( 'footer-widget-area-3' ) ) :
							        dynamic_sidebar( 'footer-widget-area-3' );
							    endif;
						    ?>
			            </div>
			        </div>
		        </div>
		    </div>
		    <div class="footer-bottom">
		        <div class="c">
		            <div class="copyright"><p>Developed by Evaldas</p></div>
		            <?php wp_nav_menu( array( 'theme_location' => 'footer_bottom_menu' ) ); ?>
		        </div>
		    </div>
		    <a href="#" id="scroll-to-top" class="scroll-to-top"><i class="fa fa-arrow-up"></i></a>
		</footer>
		<?php get_template_part('template-parts/content', 'search-popup');?>
		<?php wp_footer(); ?>
	</body>
</html>