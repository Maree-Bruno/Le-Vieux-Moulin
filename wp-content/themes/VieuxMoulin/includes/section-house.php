<div class="house-container flex flex-row">
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
