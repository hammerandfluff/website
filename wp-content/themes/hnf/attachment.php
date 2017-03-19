<?php
/**
 * The main template file
 *
 * @package hammer&amp;fluff
 * @since 0.1.0
 */

get_header(); ?>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ): the_post(); ?>
			<div class="constrained">
				<?php $att_image = wp_get_attachment_image_src( $post->id, 'full'); ?>
				<div class="attachment" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
					<a href="<?php echo esc_url( $att_image[0] ); ?>" title="<?php the_title(); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( $post_thumbnail_id, 'large' ); ?>
					</a>
					<meta itemprop="url" content="<?php echo esc_url( $att_image[0] ); ?>" />
					<meta itemprop="width" content="<?php echo esc_attr( $att_image[1] ); ?>" />
					<meta itemprop="height" content="<?php echo esc_attr( $att_image[2] ); ?>" />
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif ?>
<?php get_footer();
