<?php if ( has_post_thumbnail() ) : ?>
	<?php
		$meta	= wp_get_attachment_metadata( get_post_thumbnail_id( get_the_ID() ) );
		$width	= $meta['width'];
		$height	= $meta['height'];
	?>
	<div class="featured-image" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
		<?php the_post_thumbnail( is_singular() ? 'large' : 'medium' ); ?>
		<meta itemprop="url" content="<?php echo esc_url( the_post_thumbnail_url() ); ?>" />
		<meta itemprop="width" content="<?php echo esc_attr( $width ); ?>" />
		<meta itemprop="height" content="<?php echo esc_attr( $height ); ?>" />
	</div>
<?php endif; ?>
