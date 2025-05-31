<?php get_header(); ?>
<?php if ( have_rows( 'house_layout' ) ): while ( have_rows( 'house_layout' ) ):
	the_row(); ?>
	<?php if ( get_row_layout() === 'house_layout' ): ?>
	<section class="single-house">
	<?php
	$image = get_sub_field( 'background_image' );
	if ( ! empty( $image ) ):?>
		<figure class="single-house-fig">
			<div class="single-house-deco"></div>
			<?= responsive_image( $image, [
				'lazy'  => 'lazy',
				'class' => 'single-house-image',
			] ) ?>
			<h2 class="single-house-title font-bigtitle text-3xl">
				<?php the_title(); ?>
			</h2>
		</figure>
	<?php endif; ?>
	<section class="single-house-history">
		<h3 class="font-subtitle text-2xl single-house-history-title">Un peu <strong class="brush font-brush
		brush-red brush-bigtitle">d'histoire</strong></h3>
		<div class="single-house-history-container">
			<?php
			$images      = get_sub_field( 'historic_house_image' );
			$description = get_sub_field( 'house_description' );

			if ( $images ):
				foreach ( $images as $index => $image ):
					$position_class = $index % 2 === 0 ? 'left' : 'right';
					?>
					<div class="single-house-history-row single-house-history-row-<?= $position_class ?> grid">
						<figure class="single-house-history-fig">
							<?= responsive_image( $image, [
								'lazy'  => 'lazy',
								'class' => 'single-house-history-image',
							] ) ?>
						</figure>
						<div class="single-house-history-description">
							<?= $description ?>
						</div>
					</div>
				<?php
				endforeach;
			endif;
			?>
		</div>

	</section>
	<section class="single-house-today">
		<h3 class="font-subtitle text-2xl single-house-today-title">
			Et <strong class="brush font-brush brush-blue brush-bigtitle">aujourd'hui</strong> ?
		</h3>
		<div class="single-house-today-gallery flex flex-row">
			<?php
			$images = get_sub_field( 'house_image' );
			if ( $images ): ?>
				<?php foreach ( $images as $image ): ?>
					<a href="<?= esc_url( $image['sizes']['large'] ); ?>" data-fancybox="gallery"
					   class="single-house-today-gallery-link">
						<figure class="single-house-today-fig">
							<?= responsive_image( $image, [
								'lazy'  => 'lazy',
								'class' => 'single-house-today-image',
							] ) ?>
						</figure>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="single-house-today-description">
			<?php the_sub_field( 'today_description' ); ?>
		</div>
	</section>

	<section class="single-house-flat">
		<h3 class="font-subtitle text-2xl  single-house-flat-title">Des appartements pour l’<strong class="brush font-brush
		brush-yellow brush-bigtitle">autonomie</strong></h3>
		<div class="single-house-flat-description">
			<?php the_sub_field( 'flat' ); ?>
		</div>
	</section>
	<section class="single-house-conclusion">
		<h3 class="sr-only">Conclusion</h3>
		<div class="single-house-conclusion-description">
			<?php the_sub_field( 'conclusion' ); ?>
		</div>
	</section>
<?php endif; ?>
<?php endwhile; else: ?>
	Rien à montrer.
<?php endif; ?>
	</section>

<?php get_footer(); ?>