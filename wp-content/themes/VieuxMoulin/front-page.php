<?php
/*
 * Template Name: Home
 */
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) :
	the_post(); ?>
	<?php if ( have_rows( 'homepage_layout' ) ): while ( have_rows( 'homepage_layout' ) ):
	the_row(); ?>
	<?php if ( get_row_layout() === 'homepage_layout' ): ?>
	<section>
		<div class="background-image"></div>
		<h2>Le Vieux Moulin <strong>SRG</strong></h2>
		<div>
			<?php the_sub_field( 'description' ); ?>
		</div>
		<div>
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'about' ) ) ?>" class="">En savoir plus</a>
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'actualities' ) ) ?>" class="">Actualités</a>
		</div>
	</section>
	<section>
		<h2>Nos <strong>deux</strong> maison</h2>
		<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'vieuxmoulin' ) ) ?>" class="">Le Vieux
			Moulin</a>
		<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'edelweiss' ) ) ?>" class="">Edelweiss</a>
	</section>
	<section>
		<h2>Nos <strong>dernières</strong> actualités</h2>

	</section>
	<section>
		<h2>Comment devenir <strong>famille d’acceuil</strong> ?</h2>
		<?php the_sub_field( 'description_welcome_family' ); ?>
		<?php if ( have_rows( 'welcome_family' ) ): ?>
			<ul>
				<?php while ( have_rows( 'welcome_family' ) ): the_row(); ?>
					<h3 class=""><?php the_sub_field( 'title' ); ?></h3>
					<li class="">
						<?php the_sub_field( 'description' ); ?>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<?php the_sub_field( 'conclusion' ); ?>
	</section>
<?php endif; ?>
<?php endwhile; else: ?>
	Rien à montrer.
<?php endif; ?>
<?php endwhile;
endif;
wp_reset_postdata(); ?>
<?php get_footer(); ?>