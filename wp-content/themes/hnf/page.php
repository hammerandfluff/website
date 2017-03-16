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
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'constrained' ); ?>>
					<div itemprop="mainEntityOfPage">
						<?php if ( ! $post->hide_title ) : ?>
							<header <?php \HNF\Helpers\header_class(); ?>>
								<?php \HNF\Helpers\get_template_part( 'title' ); ?>
							</header>
						<?php endif; ?>
						<?php \HNF\Helpers\get_template_part( 'publisher', 'meta' ); ?>
						<?php \HNF\Helpers\get_template_part( 'content', 'basic' ); ?>
					</div><!--/itemprop=mainEntityOfPage-->
				</article>
			<?php endwhile; ?>
		<?php endif; ?>
<?php get_footer();
