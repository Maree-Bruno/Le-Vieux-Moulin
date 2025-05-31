<?php get_header(); ?>
<section class="single-actuality">
	<h2 class="single-actuality-title font-bigtitle text-3xl"><?php the_field( 'title' ) ?></h2>
	<section class="single-actuality-container flex flex-col">
		<h3 class="sr-only">Contenu de l'article</h3>
		<?php if ( have_rows( 'content' ) ): ?>
			<?php while ( have_rows( 'content' ) ): the_row(); ?>
				<?php
				$image    = get_sub_field( 'image' );
				$position = get_sub_field( 'position' );
				?>
				<div class="single-actuality-content single-actuality-image-<?php echo esc_attr( $position ); ?> flex
			flex-col content-center">
					<?php if ( ( $image && $position === 'left' ) || ( $image && $position === 'right' ) ): ?>
						<figure class="single-actuality-fig">
							<?= responsive_image( $image, [ 'lazy' => 'lazy', 'class' => 'single-actuality-image' ] ) ?>
						</figure>
					<?php endif; ?>

					<div class="single-actuality-text">
						<?php the_sub_field( 'content' ); ?>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>

	<section class="single-actuality-gallery">
		<h3 class="single-actuality-gallery-title font-subtitle text-3xl">Galerie</h3>
		<div class="single-actuality-gallery-container">
			<?php if ( get_field( 'need_gallery' ) === true ) :
				$images = get_field( 'gallery' );
				if ( $images ): ?>
					<?php foreach ( $images as $image ): ?>
						<a href="<?= esc_url( $image['sizes']['large'] ); ?>" data-fancybox="gallery"
						   class="single-actuality-gallery-link">
							<figure class="single-actuality-gallery-fig">
								<?= responsive_image( $image,
									[ 'lazy' => 'lazy', 'class' => 'single-actuality-gallery-image' ]
								) ?>
							</figure>
						</a>
					<?php endforeach; ?>
				<?php endif;
			endif; ?>
		</div>
	</section>
</section>

<?php get_footer(); ?>
