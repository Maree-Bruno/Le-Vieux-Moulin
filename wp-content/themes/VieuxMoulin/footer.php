</main>
<footer class="flex flex-row justify-around">
	<h2 class="sr-only">Footer</h2>
	<div class="flex flex-col">
		<h3>Nos informations</h3>
		<address>
			Rue des Vennes n°1, 6637 Fauvillers
		</address>
		<a href="tel:063601150" title="Notre numéro de téléphone">063/60.11.50</a>
		<a href="mailto:saaelevieux.moulin@gmail.com" title="Vous allez être redirigé vers votre application mail en
		cliquant ici">saaelevieux.moulin@gmail.com</a>
		<p title="Notre compte bancaire">BE93 7965 5262 8667</p>
	</div>
	<div class="flex flex-col">
		<h3 class="">Navigation</h3>
		<ul class="flex flex-col">
			<?php foreach ( vieuxmoulin_get_navigation_links( 'main' ) as $link ): ?>
				<li><a href="<?= $link->url ?>" class=""><?= $link->label ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div>
		<h3>Pour faire un don, scannez-moi !</h3>
		<figure>
			<picture>
				<img src="/wp-content/themes/VieuxMoulin/resources/img/qrcode.png" alt="QR code pour faire un don"
				     width="192" height="199" loading="lazy">
			</picture>
		</figure>
	</div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
