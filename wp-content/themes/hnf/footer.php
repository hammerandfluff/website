<?php
/**
 * The template for displaying the footer.
 *
 * @package hammer&amp;fluff
 * @since 0.1.0
 */

use HNF\Customizer\Footer as Customizer;
?>
	</main>
	<footer>
		<section class="social-bar">
			<div class="social-bar-constrain">
				<?php
				wp_nav_menu( array(
					'theme_location'=> 'footer-left',
					'container' => false,
					'menu_class' => false,
					'menu_id' => 'footer-left',
					'fallback_cb' => '__return_null'
				) );
				?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-right',
					'container' => false,
					'menu_class' => false,
					'menu_id' => 'footer-right',
					'fallback_cb' => '__return_null'
				) );
				?>
			</div>
		</section>
		<section class="hammer-bar"></section>
		<section class="copyright">
			<?php echo esc_html( Customizer\get_footer_text() ); ?>
		</section>
	</footer>
	<?php wp_footer(); ?>
	</body>
</html>
