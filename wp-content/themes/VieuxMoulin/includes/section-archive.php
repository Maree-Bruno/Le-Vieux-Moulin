<?php
$args              = [
	'post_type' => 'actualities',
];
$actualities_query = new WP_Query( $args );
?>

<?php if ( $actualities_query->have_posts() ) : ?>
	<?php while ( $actualities_query->have_posts() ) : $actualities_query->the_post(); ?>
		<article class="actualities-article flex flex-col">
			<a class="actualities-article-link" href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ): ?>
					<?= get_the_post_thumbnail( null, 'blog-small', [ 'class' => 'actualities-article-image' ]
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
				<div class="actualities-article-text "><?php the_field( 'resume' ) ?></div>

			</a>
		</article>
	<?php endwhile; ?>
<?php else: ?>
	<p>C'est vide</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
