<?php
/*
 * Template Name: foster
 */
?>
<?php get_header(); ?>
<section>
	<h2>Nos <strong>deux</strong> maison</h2>
	<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'vieuxmoulin' ) ) ?>" class="">Le Vieux
		Moulin</a>
	<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'edelweiss' ) ) ?>" class="">Edelweiss</a>
</section>
<?php get_footer(); ?>
