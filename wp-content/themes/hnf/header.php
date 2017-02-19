<?php
/**
 * The template for displaying the header.
 *
 * @package hammer&amp;fluff
 * @since 0.1.0
 */
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="tagline-bar">
				<?php esc_html_e( 'telling your story, beautifully.™', 'hnf' ); ?>
			</div>
			<h1 class="logo"><img src="<?php echo esc_url( HNF_URL . '/assets/img/hnf-logo.svg' ); ?>" /><span><?php esc_html_e( 'hammer&amp;fluff', 'hnf' ); ?></span></h1>
		</header>
		<main>
