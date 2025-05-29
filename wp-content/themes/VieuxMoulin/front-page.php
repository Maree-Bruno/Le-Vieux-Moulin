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
	<section class="hero flex flex-col content-center">
		<div class="hero-background-image flex justify-center content-center">
			<h2 class="hero-title font-bigtitle text-3xl">Le Vieux Moulin <strong class="text-xl">SRG</strong></h2>
		</div>
		<div class="hero-description text-xl">
			<?php the_sub_field( 'description' ); ?>
		</div>
		<div class="hero-link flex flex-row justify-evenly content-center">
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'template-about' ) ) ?>"
			   class="hero-button button button-red font-subtitle text-xl">En
				savoir
				plus</a>
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'frontpage-actualities.scss' ) ) ?>"
			   class="hero-button button button-blue font-subtitle text-xl">Actualités</a>
		</div>
	</section>
	<section class="house">
		<h2 class="house-title font-bigtitle text-3xl">Nos deux <strong class="brush font-brush text-4xl
		brush-red">maisons</strong></h2>
		<?php get_template_part( 'includes/section', 'house' ) ?>
	</section>

	<section class="actualities flex flex-col">
		<h2 class="actualities-title font-bigtitle text-3xl">Nos <strong class="brush font-brush text-4xl
		brush-blue">dernières</strong>
			actualités</h2>
		<div class="actualities-container flex flex-row">
			<?php
			$args              = [
				'post_type'      => 'actualities',
				'posts_per_page' => 3,
			];
			$actualities_query = new WP_Query( $args );
			?>

			<?php if ( $actualities_query->have_posts() ) : ?>
				<?php while ( $actualities_query->have_posts() ) : $actualities_query->the_post(); ?>
					<article class="actualities-article flex flex-col">
						<a class="actualities-article-link" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ): ?>
								<?= get_the_post_thumbnail( null, 'blog-small',
									[ 'class' => 'actualities-article-image' ]
								) ?>
							<?php endif; ?>
							<div class="actualities-article-container flex flex-row justify-between">
								<h3 class="actualities-article-title font-subtitle">
									<?php the_title(); ?>
								</h3>
								<time class="actualities-article-date font-subtitle">
									<?= get_the_date( 'd/m/Y' ) ?>
								</time>
							</div>
							<div class="actualities-article-text flex justify-center content-center"><?php the_field( 'resume' ) ?></div>

						</a>
					</article>
				<?php endwhile; ?>
			<?php else: ?>
				<p>C'est vide</p>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</div>
	</section>
	<section class="foster-family flex flex-col">
		<h2 class="foster-family-title font-bigtitle text-3xl">Comment devenir <strong class="brush font-brush
		tex4-4xl brush-yellow">famille&nbsp;d’acceuil</strong>&nbsp; ?</h2>
		<div class="foster-family-description">
			<?php the_sub_field( 'description_welcome_family' ); ?>
		</div>
		<?php if ( have_rows( 'welcome_family' ) ): ?>
			<ul class="foster-family-ul flex flex-col">
				<?php while ( have_rows( 'welcome_family' ) ): the_row(); ?>
					<li class="foster-family-li">
						<h3 class="foster-family-li-title font-subtitle text-xl"><?php the_sub_field( 'title' );
						?></h3>
						<div class="foster-family-li-description">
							<?php the_sub_field( 'description' ); ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<div class="foster-family-conclusion">
			<?php the_sub_field( 'conclusion' ); ?>
		</div>
	</section>
<?php endif; ?>
<?php endwhile; else: ?>
	Rien à montrer.
<?php endif; ?>
<?php endwhile;
endif;
wp_reset_postdata(); ?>
<?php get_footer(); ?>