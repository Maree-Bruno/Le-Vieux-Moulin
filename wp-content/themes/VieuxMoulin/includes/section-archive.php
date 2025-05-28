<?php
$args              = [
	'post_type' => 'actualities',
];
$actualities_query = new WP_Query( $args );
?>

<?php if ( $actualities_query->have_posts() ) : ?>
	<?php while ( $actualities_query->have_posts() ) : $actualities_query->the_post(); ?>
		<article class="article">
			<a class="article-link" href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ): ?>
					<?= get_the_post_thumbnail( null, 'blog-small', [ 'class' => 'article-image' ] ) ?>
				<?php endif; ?>
				<h3 class="article-title font-title">
					<?php the_title(); ?>
				</h3>
				<?php if ( have_rows( 'content' ) ) : while ( have_rows( 'content' ) ) : the_row(); ?>
					<div><?php the_sub_field( 'content' ) ?></div>
				<?php endwhile; endif; ?>
			</a>
		</article>
	<?php endwhile; ?>
<?php else: ?>
	<p>C'est vide</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
