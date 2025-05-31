<?php
/*
 * Template Name: actualities
 */
?>
<?php get_header(); ?>
<section class="archive-actualities flex flex-col">
	<h2 class="archive-actualities-title font-bigtitle text-3xl">Nos dernières <strong class="brush font-brush
		brush-yellow brush-bigtitle">actualités</strong> </h2>
	<div class="archive-actualities-container flex flex-col content-center">
		<?php get_template_part('includes/section', 'archive') ?>
	</div>
	<div>
		<div class="previous font-title">
			<?php previous_posts_link() ?>
		</div>
		<?= paginate_links() ?>
		<div class="next font-title">
			<?php next_posts_link() ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
