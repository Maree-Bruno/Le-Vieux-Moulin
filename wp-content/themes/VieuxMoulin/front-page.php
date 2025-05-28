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
	<section class="hero flex flex-col">
		<div class="hero-background-image flex justify-center content-center">
			<h2 class="hero-title font-bigtitle text-4xl">Le Vieux Moulin <strong class="text-lg">SRG</strong></h2>
		</div>
		<div class="hero-description text-base">
			<?php the_sub_field( 'description' ); ?>
		</div>
		<div class="hero-link flex flex-row justify-evenly content-center">
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'template-about' ) ) ?>"
			   class="hero-button button-red font-subtitle text-xl">En
				savoir
				plus</a>
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'archive-actualities' ) ) ?>"
			   class="hero-button button-blue font-subtitle text-xl">Actualités</a>
		</div>
	</section>
	<section class="house">
		<h2 class="house-title font-bigtitle text-3xl">Nos <strong class="brush brush-red">deux</strong> maison</h2>
		<div class="house-container flex flex-col">
			<?php
			$houses = new WP_Query( [
				'post_type' => 'houses'
			] );

			if ( $houses->have_posts() ):
				while ( $houses->have_posts() ):
					$houses->the_post();
					$terms   = get_the_terms( get_the_ID(), 'tags' );
					$classes = '';

					if ( $terms && ! is_wp_error( $terms ) ) {
						foreach ( $terms as $term ) {
							$classes .= ' ' . sanitize_html_class( $term->slug );
						}
					}
					?>
					<a href="<?php the_permalink(); ?>" class="<?= esc_attr( trim( $classes ) ) ?> house-link flex
					justify-center content-center"><p
								class="house-text font-subtitle text-xl"><?=
							the_title() ?></p></a>
				<?php endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
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