<?php
/*
 * Template Name: about
 */
?>
<?php get_header(); ?>
	<h2 class="about-title font-bigtitle text-3xl"><?php the_field( 'title' ) ?></h2>
	<section class="about flex flex-col-reverse justify-around">
		<h3 class="sr-only">Description du Vieux Moulin</h3>
		<div class="about-content flex flex-col justify-evenly">
			<div class="about-description"><?php the_field( 'description' ) ?></div>
			<a href="<?= get_post_type_archive_link( 'houses' ) ?>" class="button
			button-red
			about-button font-subtitle" title="Vous allez être redirigé vers la page des maisons">Nos maisons</a>
		</div>
		<?php
		$image = get_field( 'image' );
		if ( $image ): ?>
			<figure class="about-fig">
				<?= responsive_image( $image, [
					'lazy'  => 'lazy',
					'class' => 'about-image',
				] ) ?>
			</figure>
		<?php endif; ?>
	</section>
	<div class="value-objectives flex flex-col justify-center">
		<section class="value flex flex-col">
			<h3 class="value-title font-bigtitle text-2xl">Nos <strong class="brush font-brush brush-bigtitle
		brush-blue">valeurs</strong>
				éducatives</h3>
			<div class="value-description flex flex-col"><?php the_field( 'educational_values' ) ?></div>
		</section>
		<section class="objectives">
			<h3 class="objectives-title font-bigtitle text-2xl">Nos <strong class="brush font-brush brush-bigtitle
		brush-green">objectifs</strong></h3>
			<div class="objectives-description"><?php the_field( 'objectives' ) ?></div>
		</section>
	</div>
	<section class="daily-life">
		<h3 class="daily-life-title font-bigtitle text-2xl">Vie au <strong class="brush brush-yellow
			font-brush brush-bigtitle">quotidien</strong></h3>
		<div class="daily-life-description"><?php the_field( 'daily_life' ) ?></div>
		<?php if ( have_rows( 'routine' ) ) : ?>
			<section class="routine flex flex-col">
				<h3 class="sr-only">Routine des enfants dans la maison</h3>
				<?php while ( have_rows( 'routine' ) ) : the_row(); ?>
					<?php
					$layout       = get_row_layout();
					if ( $layout === 'morning_routine' || $layout === 'afternoon_routine' || $layout === 'evening_routine' ) :
						$img = get_sub_field( 'image' );
						$position = get_sub_field( 'image_position' );
						?>
						<div class="routine-block flex flex-col-reverse routine-image-<?php echo esc_attr( $position );
						?> justify-center">
							<?php if ( ( $position === 'right' && $img ) || ( $position === 'left' && $img ) ) : ?>
								<figure class="routine-fig">
									<?= responsive_image( $img, [ 'lazy' => 'lazy', 'class' => 'routine-image' ] ) ?>
								</figure>
							<?php endif; ?>
							<div class="routine-content flex flex-col">
								<h4 class="routine-content-title font-bigtitle text-xl"><?php the_sub_field( 'title'
									);
									?></h4>
								<?php if ( have_rows( 'activity' ) ) : ?>
									<?php while ( have_rows( 'activity' ) ) : the_row(); ?>
										<div class="routine-content-activity flex flex-col">
											<div class="flex flex-row">
												<time class="routine-content-activity-time font-subtitle"><?php
													the_sub_field(
														'hour' );
													?></time>
												<small class="routine-content-activity-separation font-subtitle">&nbsp;
													-&nbsp;</small>
												<h5 class="routine-content-activity-title font-subtitle"><?php the_sub_field( 'activity_title' ); ?></h5>
											</div>
											<div class="routine-content-activity-description"><?php the_sub_field( 'activity' );
												?></div>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>

						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</section>
		<?php endif; ?>

		<section class="partner">
			<h3 class="partner-title font-bigtitle text-2xl">Nos <strong class="brush brush-red
			font-brush brush-bigtitle">partenaires</strong></h3>
			<ul class="partner-ul flex flex-row content-center">
				<?php if ( have_rows( 'partenair' ) ) : while ( have_rows( 'partenair' ) ) :
					the_row(); ?>
					<?php $img = get_sub_field( 'logo' );
					if ( $img ): ?>
						<li class="partner-li">
							<figure class="parnter-fig">
								<?= responsive_image( $img, [
									'lazy'  => 'lazy',
									'class' => 'partner-image',
								] ) ?>
							</figure>
						</li>
					<?php endif;
				endwhile;
				endif; ?>
				<?php if ( have_rows( 'partenair' ) ) : while ( have_rows( 'partenair' ) ) :
					the_row(); ?>
					<?php $img = get_sub_field( 'logo' );
					if ( $img ): ?>
						<li class="partner-li">
							<figure class="parnter-fig">
								<?= responsive_image( $img, [
									'lazy'  => 'lazy',
									'class' => 'partner-image',
								] ) ?>
							</figure>
						</li>
					<?php endif;
				endwhile;
				endif; ?>
			</ul>

		</section>
	</section>
<?php get_footer(); ?>