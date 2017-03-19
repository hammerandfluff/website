<?php if ( 'yes' === $settings->titles ) : ?>
.hnf-image-grid-title {
	color: #<?php echo esc_attr( $settings->text_color ); ?>;
	font-weight: <?php echo esc_attr( $settings->text_weight ); ?>;
	text-align: <?php echo esc_attr( $settings->text_align ); ?>;
	background-color: rgba(
		<?php echo (int)hexdec( substr( $settings->text_bg_color, 0, 2 ) ); ?>,
		<?php echo (int)hexdec( substr( $settings->text_bg_color, 2, 2 ) ); ?>,
		<?php echo (int)hexdec( substr( $settings->text_bg_color, 4, 2 ) ); ?>,
		<?php echo esc_attr( $settings->text_bg_opacity ); ?>
	);
	<?php if ( $settings->title_case ) : ?>
		text-transform: <?php echo esc_attr( $settings->title_case ); ?>;
	<?php endif; ?>
}
<?php endif; ?>

@media (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
	.fl-node-<?php echo $id ?> .hnf-image-grid-item {
		margin-left: <?php echo (int)$settings->gutters_responsive ?>px;
	}

	.fl-node-<?php echo $id ?> .hnf-image-grid-item:nth-child(<?php echo (int)$settings->columns_responsive; ?>n+1) {
		margin-left: 0;
	}

	.fl-node-<?php echo $id ?> .hnf-image-grid-item:nth-child(n+<?php echo (int)$settings->columns_responsive + 1; ?>) {
		margin-top: <?php echo (int)$settings->gutters_responsive ?>px;
	}

	.fl-node-<?php echo $id ?> .hnf-image-grid-item {
		flex: 0 1 calc( 1/<?php echo (int)$settings->columns_responsive; ?>*100% - (1 - 1/<?php echo (int)$settings->columns_responsive; ?>) * <?php echo (int)$settings->gutters_responsive ?>px );
	}

	<?php if ( 'yes' === $settings->titles ) : ?>
		.hnf-image-grid-title {
			font-size: <?php echo esc_attr( $settings->text_size_responsive ); ?>px;
			padding: <?php echo esc_attr( $settings->bg_padding_top_responsive ); ?>px <?php echo esc_attr( $settings->bg_padding_right_responsive ); ?>px <?php echo esc_attr( $settings->bg_padding_bottom_responsive ); ?>px <?php echo esc_attr( $settings->bg_padding_left_responsive ); ?>px;
			<?php echo esc_attr( $settings->bg_anchor ); ?>: <?php echo esc_attr( $settings->bg_offset_responsive ); ?>px;
		}
	<?php endif; ?>
}

@media (min-width: <?php echo $global_settings->responsive_breakpoint; ?>px) and (max-width: <?php echo $global_settings->medium_breakpoint ?>px) {
	.fl-node-<?php echo $id ?> .hnf-image-grid-item {
		margin-left: <?php echo (int)$settings->gutters_medium ?>px;
	}
	.fl-node-<?php echo $id ?> .hnf-image-grid-item:nth-child(<?php echo (int)$settings->columns_medium; ?>n+1) {
		margin-left: 0;
	}

	.fl-node-<?php echo $id ?> .hnf-image-grid-item:nth-child(n+<?php echo (int)$settings->columns_medium + 1; ?>) {
		margin-top: <?php echo (int)$settings->gutters_medium ?>px;
	}

	.fl-node-<?php echo $id ?> .hnf-image-grid-item {
		flex: 0 1 calc( 1/<?php echo (int)$settings->columns_medium; ?>*100% - (1 - 1/<?php echo (int)$settings->columns_medium; ?>) * <?php echo (int)$settings->gutters_medium ?>px );

	}
	<?php if ( 'yes' === $settings->titles ) : ?>
		.hnf-image-grid-title {
			font-size: <?php echo esc_attr( $settings->text_size_medium ); ?>px;
			padding: <?php echo esc_attr( $settings->bg_padding_top_medium ); ?>px <?php echo esc_attr( $settings->bg_padding_right_medium ); ?>px <?php echo esc_attr( $settings->bg_padding_bottom_medium ); ?>px <?php echo esc_attr( $settings->bg_padding_left_medium ); ?>px;
			<?php echo esc_attr( $settings->bg_anchor ); ?>: <?php echo esc_attr( $settings->bg_offset_medium ); ?>px;
		}
	<?php endif; ?>
}
@media (min-width: <?php echo $global_settings->medium_breakpoint; ?>px) {
	.fl-node-<?php echo $id ?> .hnf-image-grid-item {
		margin-left: <?php echo (int)$settings->gutters ?>px;
	}
	.fl-node-<?php echo $id ?> .hnf-image-grid-item:nth-child(<?php echo (int)$settings->columns; ?>n+1) {
		margin-left: 0;
	}

	.fl-node-<?php echo $id ?> .hnf-image-grid-item:nth-child(n+<?php echo (int)$settings->columns + 1; ?>) {
		margin-top: <?php echo (int)$settings->gutters ?>px;
	}

	.fl-node-<?php echo $id ?> .hnf-image-grid-item {
		flex: 0 1 calc( 1/<?php echo (int)$settings->columns; ?>*100% - (1 - 1/<?php echo (int)$settings->columns; ?>) * <?php echo (int)$settings->gutters ?>px );

	}

	<?php if ( 'yes' === $settings->titles ) : ?>
		.hnf-image-grid-title {
			font-size: <?php echo esc_attr( $settings->text_size ); ?>px;
			padding: <?php echo esc_attr( $settings->bg_padding_top ); ?>px <?php echo esc_attr( $settings->bg_padding_right ); ?>px <?php echo esc_attr( $settings->bg_padding_bottom ); ?>px <?php echo esc_attr( $settings->bg_padding_left ); ?>px;
			<?php echo esc_attr( $settings->bg_anchor ); ?>: <?php echo esc_attr( $settings->bg_offset ); ?>px;
		}
	<?php endif; ?>
}
