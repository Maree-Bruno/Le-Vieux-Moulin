<?php
/*
 * Template Name: actualities
 */
?>
<?php get_header(); ?>
<section class="">
	<h2 class="title font-title">Nos dernières <strong>actualités</strong> </h2>
	<div class="">
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
