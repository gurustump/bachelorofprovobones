	<?php include('library/svg.php'); ?>
			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="wrap cf">
				
					<div class="footer-logo">
						<a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a>
					</div>

					<nav class="footer-nav" role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
					
					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
					
					<div class="social">
						<a class="svg-container" target="_blank" href="https://www.instagram.com/provosmosteligible/"><?php echo $icInstagram; ?></a>
						<a class="svg-container" target="_blank" href="https://twitter.com/provo_bachelor"><?php echo $icTwitter; ?></a>
						<a class="svg-container" target="_blank" href="https://www.youtube.com/channel/UCOw0nF1kZiGxE5bsmKowwLA"><?php echo $icYoutube; ?></a>
						<a class="svg-container" target="_blank" href="https://www.facebook.com/The-Bachelor-of-Provo-334040420513716/" class="fb"><?php echo $icFacebook; ?></a>
					</div>

				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
