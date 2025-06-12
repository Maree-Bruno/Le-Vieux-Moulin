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
	<section class="hero flex flex-col content-center" itemscope itemtype="https://schema.org/Organization">
		<div>
			<?php
			$image = get_sub_field( 'background-image' );
			if ( ! empty( $image ) ): ?>
				<figure class="hero-fig" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<div class="hero-deco"></div>
					<?= responsive_image( $image, [
						'lazy'  => 'eager',
						'class' => 'hero-image',
					] ) ?>
					<meta itemprop="url" content="<?= esc_url( $image['url'] ); ?>"/>
					<meta itemprop="width" content="<?= $image['width']; ?>">
					<meta itemprop="height" content="<?= $image['height']; ?>">
				</figure>
			<?php endif; ?>
			<h2 class="hero-title font-bigtitle text-3xl" itemprop="name">Le Vieux Moulin <strong
						class="text-xl">SRG</strong></h2>
		</div>
		<div class="hero-description text-xl" itemprop="description">
			<?php the_sub_field( 'description' ); ?>
		</div>
		<div class="hero-link flex flex-row justify-evenly content-center">
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'template-about' ) ) ?>"
			   class="hero-button button button-red font-subtitle text-xl">En savoir plus</a>
			<a href="<?= get_the_permalink( vieuxmoulin_get_template_page( 'frontpage-actualities.scss' ) ) ?>"
			   class="hero-button button button-blue font-subtitle text-xl">Actualités</a>
		</div>
	</section>
	<section class="house" itemscope itemtype="https://schema.org/Place">
		<h2 class="house-title font-bigtitle text-3xl" itemprop="name">Nos deux <strong
					class="brush font-brush brush-bigtitle brush-red brush-bigtitle">maisons</strong></h2>
		<?php get_template_part( 'includes/section', 'house' ) ?>
	</section>
	<section class="frontpage-actualities flex flex-col" itemscope itemtype="https://schema.org/ItemList">
		<h2 class="frontpage-actualities-title font-bigtitle text-3xl" itemprop="name">Nos <strong
					class="brush font-brush brush-bigtitle brush-blue">dernières</strong> actualités</h2>
		<div class="frontpage-actualities-container flex flex-row">
			<?php
			$args              = [
				'post_type'      => 'actualities',
				'posts_per_page' => 3,
			];
			$actualities_query = new WP_Query( $args );
			?>

			<?php if ( $actualities_query->have_posts() ) : ?>
				<?php while ( $actualities_query->have_posts() ) : $actualities_query->the_post(); ?>
					<article class="frontpage-actualities-article flex flex-col" itemscope
					         itemtype="https://schema.org/NewsArticle">
						<a class="frontpage-actualities-article-link" href="<?php the_permalink(); ?>" itemprop="url">
							<?php if ( has_post_thumbnail() ): ?>
								<figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
									<?= get_the_post_thumbnail( null, 'blog-small',
										[ 'class' => 'frontpage-actualities-article-image' ] ) ?>
									<meta itemprop="url" content="<?= get_the_post_thumbnail_url(); ?>">
								</figure>
							<?php endif; ?>
							<div class="frontpage-actualities-article-container flex flex-row justify-between">
								<h3 class="frontpage-actualities-article-title font-subtitle" itemprop="headline">
									<?php the_title(); ?>
								</h3>
								<time class="frontpage-actualities-article-date font-subtitle" itemprop="datePublished"
								      datetime="<?= get_the_date( 'c' ); ?>">
									<?= get_the_date( 'd/m/Y' ) ?>
								</time>
							</div>
							<div class="frontpage-actualities-article-text flex justify-center content-center"
							     itemprop="description">
								<?php the_field( 'resume' ) ?>
							</div>
						</a>
					</article>
				<?php endwhile; ?>
			<?php else: ?>
				<p>C'est vide</p>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</div>
	</section>
	<section class="foster-family flex flex-col" itemscope itemtype="https://schema.org/HowTo">
		<h2 class="foster-family-title font-bigtitle text-3xl" itemprop="name">
			Comment devenir <strong class="brush font-brush brush-bigtitle brush-yellow">famille&nbsp;d’accueil</strong>&nbsp;
			?
		</h2>
		<div class="foster-family-description" itemprop="description">
			<?php the_sub_field( 'description_welcome_family' ); ?>
		</div>
		<?php if ( have_rows( 'welcome_family' ) ): ?>
			<ul class="foster-family-ul flex flex-col justify-center content-center" itemprop="step">
				<?php while ( have_rows( 'welcome_family' ) ): the_row(); ?>
					<li class="foster-family-li" itemscope itemtype="https://schema.org/HowToStep">
						<h3 class="foster-family-li-title font-subtitle text-xl"
						    itemprop="name"><?php the_sub_field( 'title' ); ?></h3>
						<div class="foster-family-li-description" itemprop="text">
							<?php the_sub_field( 'description' ); ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<div class="foster-family-conclusion" itemprop="description">
			<?php the_sub_field( 'conclusion' ); ?>
		</div>
	</section>
<?php endif; ?>
<?php endwhile; else: ?>
	Rien à montrer.
<?php endif; ?>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
