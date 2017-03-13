<!-- Main body of the article -->
<div itemprop="articleBody">
	<?php if ( -1 !== strpos( $post->post_content, '<!--more' ) ) : ?>
		<?php the_content(); ?>
	<?php else: ?>
		<?php the_excerpt(); ?>
	<?php endif; ?>
</div><!--/itemprop=articleBody-->
