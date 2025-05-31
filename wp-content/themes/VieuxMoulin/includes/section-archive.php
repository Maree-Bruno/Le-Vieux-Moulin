<?php
$args              = [
	'post_type' => 'actualities',
];
$actualities_query = new WP_Query( $args );
?>

<?php if ( $actualities_query->have_posts() ) : ?>
	<?php while ( $actualities_query->have_posts() ) : $actualities_query->the_post(); ?>
		<article class="archive-actualities-article flex flex-col">
			<a class="archive-actualities-article-link flex flex-col" href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ): ?>
					<?= get_the_post_thumbnail( null, 'blog-small', [ 'class' => 'archive-actualities-article-image' ]
					) ?>
				<?php endif; ?>
				<div class="archive-actualities-article-content flex flex-col">
					<div class="archive-actualities-article-container flex flex-row justify-between content-center">
						<h3 class="archive-actualities-article-title font-subtitle">
							<?php the_title(); ?>
						</h3>
						<time class="archive-actualities-article-date font-subtitle">
							<?= get_the_date( 'd/m/Y' ) ?>
						</time>
					</div>
					<div class="archive-actualities-article-text "><?php the_field( 'resume' ) ?></div>
				</div>

			</a>
		</article>
	<?php endwhile; ?>
<?php else: ?>
	<p>C'est vide</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
