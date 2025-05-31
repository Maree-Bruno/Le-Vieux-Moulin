<?php
/*
 * Template Name: Contact
 */
?>
<?php get_header(); ?>
<section class="contact flex flex-col justify-between content-start">
	<div class="contact-content">
		<h2 class="contact-content-title font-bigtitle text-3xl"> Besoin d'un <strong class="brush font-brush text-4xl
		brush-yellow brush-bigtitle">renseignement</strong> ?</h2>
		<div class="contact-content-description flex content-center">
			<?php the_field( 'description' ); ?>
		</div>
	</div>
	<div class="contact-form-validation">
		<?php
		$feedback = vieuxmoulin_session_get( 'vieuxmoulin_contact_form_feedback' ) ?? false;
		$errors   = vieuxmoulin_session_get( 'vieuxmoulin_contact_form_errors' ) ?? [];
		?>
		<?php if ( $feedback ): ?>
			<div class="success">
				<p class="success-text">Merci ! Message bien reçu !</p>
			</div>
		<?php endif; ?>

		<?php if ( $errors ): ?>
			<div class="error">
				<p class="error-text">Veuillez vérifier les champs du formulaire.</p>
			</div>
		<?php endif; ?>

		<form action="<?= esc_url( admin_url( 'admin-post.php' ) ) ?>" method="POST" class="contact-form">
			<fieldset class="contact-form-fieldset flex flex-col content-center">
				<div class="contact-form-container flex flex-col">
					<div class="contact-form-container-informations flex flex-col">
						<div class="contact-form-container-informations-firstname flex flex-col">
							<label for="firstname" class="contact-form-container-informations-label
							font-subtitle">
								Prénom(*)
							</label>
							<input type="text" name="firstname" id="firstname" placeholder="Jean"
							       class="contact-form-container-informations-input font-text"/>
							<?php if ( $errors['firstname'] ?? null ): ?>
								<p class="error-text"><?= $errors['firstname']; ?></p>
							<?php endif; ?>
						</div>
						<div class="contact-form-container-informations-lastname flex flex-col">
							<label for="lastname" class="contact-form-container-informations-label font-subtitle">Nom(*)
							</label>
							<input type="text" name="lastname" id="lastname" placeholder="Valjean"
							       class="contact-form-container-informations-input font-text"/>
							<?php if ( $errors['lastname'] ?? null ): ?>
								<p class="error-text"><?= $errors['lastname']; ?></p>
							<?php endif; ?>
						</div>

						<div class="contact-form-container-informations-email flex flex-col">
							<label for="email" class="contact-form-container-informations-label font-subtitle">Adresse mail(*)
							</label>
							<input type="email" name="email" id="email" placeholder="jeanvaljean@gmail.com"
							       class="contact-form-container-informations-input font-text"/>
							<?php if ( $errors['email'] ?? null ): ?>
								<p class="error-text"><?= $errors['email']; ?></p>
							<?php endif; ?>
						</div>
					</div>
					<div class="contact-form-container-informations-message flex flex-col">
						<label for="message" class="contact-form-container-informations-label font-subtitle">Your
							Message</label>
						<textarea name="message" id="message" cols="30" rows="5" placeholder="Votre message"
						          class="contact-form-container-informations-textarea font-text"></textarea>
						<?php if ( $errors['message'] ?? null ): ?>
							<p class="error-text"><?= $errors['message'] ?></p>
						<?php endif; ?>
					</div>
				</div>
				<div class="contact-form-container-informations-validation">
					<input type="hidden" name="action" value="vieuxmoulin_contact_form"/>
					<input type="hidden" name="contact_nonce"
					       value="<?= wp_create_nonce( 'vieuxmoulin_contact_form' ) ?>"/>
					<button class="contact-form-button font-bigtitle button-red button text-2xl"
					        type="submit">Envoyer</button>
				</div>
			</fieldset>
		</form>
	</div>

	<?php get_footer(); ?>

