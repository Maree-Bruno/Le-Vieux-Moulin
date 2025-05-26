<?php get_header(); ?>
<section>
	<h2><?php the_field( 'title' ) ?></h2>
	<?php if ( have_rows( 'content' ) ): ?>
		<?php while ( have_rows( 'content' ) ):
			the_row(); ?>
			<div class=" flex">
				<?php
				$image = get_sub_field( 'image' );
				if ( $image ): ?>
					<figure>
						<img src="<?= esc_url( $image['sizes']['blog-medium'] ); ?>"
						     alt="<?= esc_attr( $image['alt'] ); ?>"/>
					</figure>
				<?php endif; ?>
				<div>
					<?php the_sub_field( 'content' ); ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php
	if(get_field('need_gallery') === true) : ?>
	<?php
	$images = get_field( 'gallery' );
	if ( $images ): ?>
		<div class="">
			<?php foreach ( $images as $image ): ?>
				<a href="<?= esc_url( $image['sizes']['large'] ); ?>" data-fancybox="gallery">
					<img src="<?= esc_url( $image['sizes']['blog-medium'] ); ?>"
					     alt="<?= esc_attr( $image['alt'] ); ?>"/>
				</a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php endif; ?>
</section>


<?php get_footer(); ?>
