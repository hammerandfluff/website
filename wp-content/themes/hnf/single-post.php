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
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/BlogPosting">
							<?php \HNF\Helpers\get_template_part( 'header' ); ?>
							<?php \HNF\Helpers\get_template_part( 'publisher', 'meta' ); ?>
							<?php \HNF\Helpers\get_template_part( 'content', 'excerpt' ); ?>
					</article><!--/itemtype=BlogPosting-->
				</div>
			<?php endwhile; ?>
		<?php else: ?>
			<div class="constrained">
				<h2><?php esc_html_e( 'Nothing found', 'hnf' ); ?></h2>
				<?php esc_html_e( 'Sorry, you found a page with no content. :(', 'hnf' ); ?>
			</div>
		<?php endif ?>
		<div class="paged-nav constrained">
			<?php posts_nav_link(
				' ',
				__( 'Newer Posts', 'hnf' ),
				__( 'Older Posts', 'hnf' )
			); ?>
		</div>
<?php get_footer();
