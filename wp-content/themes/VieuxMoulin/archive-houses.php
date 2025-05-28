<?php
/*
 * Template Name: foster
 */
?>
<?php get_header(); ?>
<section>
	<h2>Nos <strong>deux</strong> maison</h2>
	<?php
	$houses = new WP_Query( [
		'post_type' => 'houses'
	] );
	if ( $houses->have_posts() ): while ( $houses->have_posts() ):
		$houses->the_post(); ?>
		<a href="<?php the_permalink(); ?>" class=""><?= the_title()?></a>
	<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
