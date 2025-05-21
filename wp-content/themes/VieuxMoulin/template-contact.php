<?php
/*
 * Template Name: Contact
 */
?>
<?php get_header(); ?>
<div class="">
	<div>
		<h2 class=""> Besoin d'un <strong>rensignement</strong> ?</h2>
		<div>
			<?php the_field( 'description' ); ?>
		</div>
	</div>
	<div>
		<?php
		$feedback = vieuxmoulin_session_get( 'vieuxmoulin_contact_form_feedback' ) ?? false;
		$errors   = vieuxmoulin_session_get( 'vieuxmoulin_contact_form_errors' ) ?? [];
		?>
		<?php if ( $feedback ): ?>
			<div class="success">
				<p>Merci ! Message bien reçu !</p>
			</div>
		<?php endif; ?>

		<?php if ( $errors ): ?>
			<div class="error">
				<p>Ce n'est pas ce qui est attendu.</p>
			</div>
		<?php endif; ?>

		<form action="<?= esc_url( admin_url( 'admin-post.php' ) ) ?>" method="POST" class="contact">
			<fieldset class="l">
				<div class="">
					<div class="">
						<div class="">
							<label for="firstname" class="">First Name (*)</label>
							<input type="text" name="firstname" id="firstname" class=""/>
							<?php if ( $errors['firstname'] ?? null ): ?>
								<p class="error"><?= $errors['firstname']; ?></p>
							<?php endif; ?>
						</div>
						<div class="">
							<label for="lastname" class="">Last Name (*)</label>
							<input type="text" name="lastname" id="lastname" class=""/>
							<?php if ( $errors['lastname'] ?? null ): ?>
								<p class="error"><?= $errors['lastname']; ?></p>
							<?php endif; ?>
						</div>

						<div class="">
							<label for="email" class="">Email (*)</label>
							<input type="email" name="email" id="email" class=""/>
							<?php if ( $errors['email'] ?? null ): ?>
								<p class="error"><?= $errors['email']; ?></p>
							<?php endif; ?>
						</div>
					</div>
					<div class="">
						<label for="message" class="">Your Message</label>
						<textarea name="message" id="message" cols="30" rows="5" class=""></textarea>
						<?php if ( $errors['message'] ?? null ): ?>
							<p class="error"><?= $errors['message'] ?></p>
						<?php endif; ?>
					</div>
				</div>
				<div class="">
					<input type="hidden" name="action" value="vieuxmoulin_contact_form"/>
					<input type="hidden" name="contact_nonce"
					       value="<?= wp_create_nonce( 'vieuxmoulin_contact_form' ) ?>"/>
					<button class="" type="submit">Submit</button>
				</div>
			</fieldset>
		</form>
	</div>

	<?php get_footer(); ?>

