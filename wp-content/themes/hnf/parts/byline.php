<div class="byline">
	<a href="<?php the_permalink() ?>" itemprop="url" rel="bookmark"><span itemprop="datePublished"><time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" pubdate><?php the_date(); ?></time></span></a>
	 <?php esc_html_e( 'by', 'hnf' ); ?>
	 <span itemprop="author"><?php the_author_posts_link(); ?></span>
</div>
