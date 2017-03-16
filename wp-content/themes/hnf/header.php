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
	<body <?php body_class( 'sticky-header' ); ?>>
		<header class="site-header" id="site-header">
			<div class="tagline-bar">
				<?php esc_html_e( 'telling your story, beautifully.™', 'hnf' ); ?>
			</div>
			<div class="header-drawer">
				<div class="constrained">
					<<?php echo !is_singular() ? 'h1' : 'div' ?> class="logo" itemscope itemtype="http://schema.org/Organization">
					<a itemprop="url" href="<?php echo home_url( '', 'relative' ); ?>">
						<img itemprop="logo" src="<?php echo esc_url( HNF_URL . '/assets/img/hnf-logo.svg' ); ?>" alt="" />
						<span class="screen-reader-text"><?php echo esc_attr( bloginfo( 'name' ) ); ?></span>
					</a>
					</<?php echo !is_singular() ? 'h1' : 'div' ?>>
					<nav class="site-navigation nav-menu" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
						<?php
						wp_nav_menu( array(
							'container' => false,
							'menu_class' => false,
							'menu_id' => 'primary',
							'fallback_cb' => '__return_null'
						) );
						?>
					</nav>
				</div>
			</div>
		</header>
		<main>
