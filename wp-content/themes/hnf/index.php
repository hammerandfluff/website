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
							<header>
								<?php \HNF\Helpers\get_template_part( 'title' ); ?>
							</header>
							<?php \HNF\Helpers\get_template_part( 'publisher', 'meta' ); ?>
							<?php \HNF\Helpers\get_template_part( 'content', 'excerpt' ); ?>
					</article><!--/itemtype=BlogPosting-->
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
<?php get_footer();
