<?php
/*
 * Template Name: about
 */
?>
<?php get_header(); ?>
	<section class="flex flex-row justify-between">
		<div class="flex flex-col justify-evenly">
			<h2><?php the_field( 'title' ) ?></h2>
			<div><?php the_field( 'description' ) ?></div>
			<a href="<?php get_permalink( vieuxmoulin_get_template_page( 'foyers' ) ) ?>">Nos foyers</a>
		</div>
		<div><?php the_field( 'video' ) ?></div>
	</section>
	<div class="flex flex-row justify-between">
		<section>
			<h3>Nos <strong>valeurs</strong> éducatives</h3>
			<div><?php the_field( 'educational_values' ) ?></div>
		</section>
		<section>
			<h3>Nos <strong>objectifs</strong></h3>
			<div><?php the_field( 'objectives' ) ?></div>
		</section>
	</div>
	<section>
		<h3>Vie au <strong>quotidien</strong></h3>
		<div><?php the_field( 'daily_life' ) ?></div>
		<?php if ( have_rows( 'routine' ) ) : ?>
			<div>
				<?php while ( have_rows( 'routine' ) ) : the_row(); ?>
					<?php
					$layout = get_row_layout();
					if ( $layout === 'morning_routine' || $layout === 'afternoon_routine' || $layout === 'evening_routine' ) :
						?>
						<div>
							<div>
								<h4><?php the_sub_field( 'title' ); ?></h4>
								<?php if ( have_rows( 'activity' ) ) : ?>
								<?php while ( have_rows( 'activity' ) ) : the_row(); ?>
									<div>
										<time><?php the_sub_field( 'hour' ); ?></time>
										<h5><?php the_sub_field( 'activity_title' ); ?></h5>
										<div><?php the_sub_field( 'activity' ); ?></div>
									</div>
								<?php endwhile; ?>
							</div>
							<?php endif; ?>
							<?php $img = get_sub_field( 'image' );
							if ( $img ) : ?>
								<figure>
									<?= responsive_image( $img, [
										'lazy'  => 'lazy',
										'class' => '',
									] ) ?>
								</figure>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<section>
			<h3>Nos <strong>partenaires</strong></h3>
			<?php if ( have_rows( 'partenair' ) ) : while ( have_rows( 'partenair' ) ) : the_row(); ?>
				<?php $img = get_sub_field( 'logo' );
				if ( $img ): ?>
					<li class="">
						<figure>
							<?= responsive_image( $img, [
								'lazy'  => 'lazy',
								'class' => '',
							] ) ?>
						</figure>
					</li>
				<?php endif; endwhile; endif; ?>
		</section>
	</section>
<?php get_footer(); ?>