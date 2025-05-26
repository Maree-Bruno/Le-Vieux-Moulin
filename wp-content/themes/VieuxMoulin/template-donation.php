<?php
/*
 * Template Name: donations
 */
?>
<?php get_header(); ?>
	<section class="flex flex-row">
		<div>
			<h2>Pourquoi nous faire des <strong>dons</strong> ?</h2>
			<div><?php the_field( 'description' ) ?></div>
		</div>
		<figure class="">
			<picture>
				<img class=""
				     src="/wp-content/themes/VieuxMoulin/resources/img/donation.jpg"
				     alt="Une image d'une main tendant de l'argent et une autre un coeur"
				     width="722"
				     height="428"
				     loading="lazy">
			</picture>
		</figure>
	</section>
	<section>
		<h3>Différents types de dons sont possibles :</h3>
		<?php if ( have_rows( 'donations_types' ) ) : ?>
			<?php while ( have_rows( 'donations_types' ) ) : the_row(); ?>
				<?php if ( get_row_layout() === 'layout' ) : ?>
					<?php if ( have_rows( 'type' ) ) : ?>
						<?php while ( have_rows( 'type' ) ) : the_row(); ?>
							<div class="flex flex-row">
								<div class="flex flex-col">
									<h4><?php the_sub_field( 'title' ); ?></h4>
									<div><?php the_sub_field( 'description' ); ?></div>
								</div>
								<?php $img = get_sub_field( 'icon' ); ?>
								<?php if ( $img ) : ?>
									<figure>
										<?= responsive_image( $img, [
											'lazy'  => 'lazy',
											'class' => ''
										] ) ?>
									</figure>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>

<?php get_footer(); ?>