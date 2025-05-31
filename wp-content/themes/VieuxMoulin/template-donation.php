<?php
/*
 * Template Name: donations
 */
?>
<?php get_header(); ?>
	<h2 class="donation-title font-bigtitle text-3xl">Pourquoi nous faire des <strong class="brush font-brush text-4xl
		brush-yellow brush-bigtitle">dons</strong> ?</h2>
	<section class="donation flex flex-col-reverse">
		<div class="donation-content">
			<h3 class="sr-only">Description des dons</h3>
			<div class="donation-description"><?php the_field( 'description' ) ?></div>
		</div>
		<?php
		$image = get_field( 'image' );
		if ( $image ): ?>
			<figure class="donation-fig">
				<?= responsive_image( $image, [
					'lazy'  => 'lazy',
					'class' => 'donation-image',
				] ) ?>
			</figure>
		<?php endif; ?>
	</section>
	<section class="donation-types">
		<h3 class="donation-types-title font-bigtitle text-2xl">Différents types de dons sont possibles :</h3>
		<?php
		$brush_classes = [ 'red', 'green', 'blue', 'yellow' ]; // Tes 4 couleurs dispo
		$index         = 0;
		?>

		<?php if ( have_rows( 'donations_types' ) ) : ?>
			<?php while ( have_rows( 'donations_types' ) ) : the_row(); ?>
				<?php if ( get_row_layout() === 'layout' ) : ?>
					<?php if ( have_rows( 'type' ) ) : ?>
						<?php while ( have_rows( 'type' ) ) : the_row(); ?>
							<?php
							$brush_color = $brush_classes[ $index % count( $brush_classes ) ];
							$index ++;
							?>
							<section class="donation-types-container flex flex-col content-center">
								<div class="donation-types-content flex flex-col">
									<h4 class="donation-types-content-title">
										<strong class="brush font-brush text-4xl brush-<?php echo $brush_color; ?>">
											<?php the_sub_field( 'title' ); ?>
										</strong>
									</h4>
									<div class="donation-types-content-description">
										<?php the_sub_field( 'description' ); ?>
									</div>
								</div>
								<?php $img = get_sub_field( 'icon' ); ?>
								<?php if ( $img ) : ?>
									<figure class="donation-types-content-fig">
										<?= responsive_image( $img, [
											'lazy'  => 'lazy',
											'class' => 'donation-types-content-image'
										] ) ?>
									</figure>
								<?php endif; ?>
							</section>
						<?php endwhile; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>

	</section>

<?php get_footer(); ?>