<?php
/*
 * Template Name: house
 */
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) :the_post(); ?>
	<?php if ( have_rows( 'house_layout' ) ): while ( have_rows( 'house_layout' ) ):
		the_row(); ?>
		<?php if ( get_row_layout() === 'house_layout' ): ?>
		<section>
			<h2 class="">
				<?php the_title(); ?>
			</h2>
			<figure class="">
				<?php
				$image = get_sub_field( 'background_image' );
				if ( ! empty( $image ) ):
					$image_url = $image['sizes']['large'];
					?>
					<img src="<?= esc_url( $image_url ) ?>"
					     alt="<?= esc_attr( $image['alt'] ) ?>" itemprop="image"
					     class="single-project-content-img"/>
				<?php endif; ?>
			</figure>
		</section>
		<section>
			<h2>Un peu <strong>d'histoire</strong></h2>
			<div>
				<?php
				$images = get_sub_field( 'historic_house_image' );
				if ( $images ): ?>
				<div class="">
					<?php foreach ( $images as $image ): ?>
						<figure class="">
							<img src="<?= esc_url( $image['sizes']['blog-medium'] ); ?>"
							     alt="<?= esc_attr( $image['alt'] ); ?>"
							     class=""/>
						</figure>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div>
				<?php the_sub_field( 'house_description' ); ?>
			</div>
		</section>
		<section>
			<h2>Et <strong>aujourd'hui</strong> ?</h2>
			<div>
				<?php
				$images = get_sub_field( 'house_image' );
				if ( $images ): ?>
					<?php foreach ( $images as $image ): ?>
						<a href="<?= esc_url( $image['sizes']['large'] ); ?>" data-fancybox="gallery">
							<img src="<?= esc_url( $image['sizes']['blog-medium'] ); ?>"
							     alt="<?= esc_attr( $image['alt'] ); ?>"
							     class=""/>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div>
				<?php the_sub_field( 'today_description' ); ?>
			</div>
		</section>
		<section>
			<h2>Des appartements pour l’<strong>autonomie</strong></h2>
			<?php the_sub_field( 'flat' ); ?>
		</section>
		<section>
			<h2 class="sr-only">Conclusion</h2>
			<?php the_sub_field( 'conclusion' ); ?>

		</section>
	<?php endif; ?>
	<?php endwhile; else: ?>
		Rien à montrer.
	<?php endif; ?>
<?php endwhile;endif;
wp_reset_postdata(); ?>
<?php get_footer(); ?>