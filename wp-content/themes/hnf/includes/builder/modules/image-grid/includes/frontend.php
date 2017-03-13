<?php  if ( count( $settings->items ) ) : ?>
	<div class="hnf-image-grid">
	<?php for( $i = 0; $i < count( $settings->items ); $i++ ) : ?>

		<?php if( $settings->items[ $i ]->link ) : ?>
			<a class="hnf-image-grid-item" href="<?php echo esc_url( $settings->items[ $i ]->link ); ?>">
		<?php else: ?>
			<div class="hnf-image-grid-item">
		<?php endif; ?>

			<div class="hnf-image-grid-inner">

				<?php if( $settings->items[ $i ]->image_src ) : ?>
					<img class="hnf-image-grid-image" src="<?php echo esc_attr( $settings->items[ $i ]->image_src ); ?>" data-object-fit="cover" />
				<?php endif; ?>

				<?php if ( $settings->items[ $i ]->title && 'yes' === $settings->titles ) : ?>
					<div class="hnf-image-grid-title">
						<?php echo esc_html( $settings->items[ $i ]->title ); ?>
					</div>
				<?php endif; ?>

			</div>

		<?php if( $settings->items[ $i ]->link ) : ?>
			</a>
		<?php else: ?>
			</div>
		<?php endif; ?>
	<?php endfor; ?>
	</div>
	<?php \HNF\Builder\Modules\ImageGrid::scripts(); ?>
<?php endif; ?>
