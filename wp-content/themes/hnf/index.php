<?php
/**
 * The main template file
 *
 * @package hammer&amp;fluff
 * @since 0.1.0
 */

get_header(); ?>
<?php $key   = 'dummy';
$value = '100';

$dummy_value = wp_cache_get( $key );

if ( $value !== $dummy_value ) {
    echo "The dummy value is not in cache. Adding the value now.";
    wp_cache_set( $key, $value );
} else {
    echo "Value is " . $dummy_value . ". The WordPress Memcached Backend is working!";
}?>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ): the_post(); ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>

<?php get_footer();
