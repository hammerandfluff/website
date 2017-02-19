<?php
/**
 * The template for displaying the footer.
 *
 * @package hammer&amp;fluff
 * @since 0.1.0
 */
?>
	</main>
	<footer>
		<section class="social-bar">
			<div class="social-bar-constrain">
				<a href="#"><?php esc_html_e( 'Facebook', 'hnf' ); ?></a><a href="https://www.instagram.com/hammerandfluff/"><?php esc_html_e( 'Instagram', 'hnf' ); ?></a>
			</div>
		</section>
		<section class="hammer-bar"></section>
		<section class="copyright">
			<?php printf( esc_html__( '&copy;%s hammer&amp;fluff | All Rights Reserved', 'hnf' ), date('Y') ); ?>
		</section>
	</footer>
	<?php wp_footer(); ?>
	</body>
</html>
