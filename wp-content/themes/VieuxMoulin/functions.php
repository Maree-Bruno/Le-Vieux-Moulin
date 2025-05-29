<?php

use Src\ContactForm;

// Démarrer le système de sessions pour pouvoir afficher des messages de feedback venant des formulaires.
if ( session_status() === PHP_SESSION_NONE ) {
	session_start();
}

require_once( __DIR__ . '/src/ContactForm.php' );

//theme options
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'widgets' );
function my_remove_admin_menus(): void {
	remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'my_remove_admin_menus' );

function init_remove_support(): void {
	remove_post_type_support( 'post', 'editor' );
	remove_post_type_support( 'page', 'editor' );
	remove_post_type_support( 'product', 'editor' );
	remove_post_type_support( 'houses', 'editor' );
	remove_post_type_support( 'actualities', 'editor' );
}

add_action( 'init', 'init_remove_support', 100 );
//Menus
register_nav_menu( 'main', 'Navigation principale, en-tête du site' );
register_nav_menu( 'footer', 'Navigation secondaire, navigation du pied-de-page' );

/*
 * Disable guttenberg
 */
add_filter( 'use_block_editor_for_post', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );
add_action( 'wp_enqueue_scripts', static function () {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
},
	20 );
function vieuxmoulin_get_navigation_links( string $location ): array {
	// Pour $location, retrouver le menu.
	$locations = get_nav_menu_locations();
	$menuId    = $locations[ $location ] ?? null;

	// Au cas où il n'y a pas de menu assignés à $location, renvoyer un tableau de liens vide.
	if ( is_null( $menuId ) ) {
		return [];
	}

	// Pour ce menu, récupérer les liens
	$items = wp_get_nav_menu_items( $menuId );

	// Formater les liens en objets pour ne garder que "URL" et "label" comme propriétés
	foreach ( $items as $key => $item ) {
		$items[ $key ]        = new stdClass();
		$items[ $key ]->url   = $item->url;
		$items[ $key ]->label = $item->title;
		$items[ $key ]->icon  = get_field( 'icon', $item );
	}

	// Retourner le tableau de liens formatés
	return $items;
}

function vieuxmoulin_get_template_page( string $template ): int|WP_Post|null {
	$query = new WP_Query( [
		'post_type'   => 'page',
		'post_status' => 'publish',
		'meta_query'  => [
			[
				'key'   => '_wp_page_template',
				'value' => $template . '.php',
			],
		]
	] );

	return $query->posts[0] ?? null;
}

// Fonctions propres au thème :

// 1. Charger un fichier "public" (asset/image/css/script/...) pour le front-end.
function vieuxmoulin_asset( string $file ): string {
	return get_template_directory_uri() . '/public/' . $file;
}

//custom images sizes
add_image_size( 'blog-large', 800, 600 );
add_image_size( 'blog-medium', 640, 480 );
add_image_size( 'blog-small', 320, 240, true );
add_image_size( 'blog-xsmall', 240, 200 );

function actuality_post_type(): void {
	$args = [
		'labels'       => [
			'name'          => 'Actualities',
			'singular_name' => 'Actuality',
		],
		'hierarchical' => false,
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-media-default',
		'supports'     => [ 'title', 'thumbnail', 'editor', 'page-attributes' ],
	];
	register_post_type( 'actualities', $args );
}

add_action( 'init', 'actuality_post_type' );


function actuality_taxonomy(): void {
	$args = [
		'labels'       => [
			'name'          => 'tags',
			'singular_name' => 'tag',
		],
		'public'       => true,
		'hierarchical' => true,
	];
	register_taxonomy( 'tags', [ 'actualities' ], $args );
}

add_action( 'init', 'actuality_taxonomy' );
function house_post_type(): void {
	$args = [
		'labels'       => [
			'name'          => 'Houses',
			'singular_name' => 'House',
		],
		'hierarchical' => false,
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-admin-multisite',
		'supports'     => [ 'title', 'thumbnail', 'editor', 'page-attributes' ],
	];
	register_post_type( 'houses', $args );
}

add_action( 'init', 'house_post_type' );


function house_taxonomy(): void {
	$args = [
		'labels'       => [
			'name'          => 'tags',
			'singular_name' => 'tag',
		],
		'public'       => true,
		'hierarchical' => true,
	];
	register_taxonomy( 'tags', [ 'houses' ], $args );
}

add_action( 'init', 'house_taxonomy' );
function vieuxmoulin_execute_contact_form(): void {
	$config = [
		'nonce_field'      => 'contact_nonce',
		'nonce_identifier' => 'vieuxmoulin_contact_form',
	];

	( new ContactForm( $config, $_POST ) )
		->sanitize( [
			'firstname' => 'text_field',
			'lastname'  => 'text_field',
			'email'     => 'email',
			'message'   => 'textarea_field',
		] )
		->validate( [
			'firstname' => [ 'required' ],
			'lastname'  => [ 'required' ],
			'email'     => [ 'required', 'email' ],
			'message'   => [ 'required' ],
		] )
		->save(
			title: fn( $data ) => $data['firstname'] . ' ' . $data['lastname'] . ' <' . $data['email'] . '>',
			content: fn( $data ) => $data['message'],
		)
		->send(
			title: fn( $data ) => 'Nouveau message de ' . $data['firstname'] . ' ' . $data['lastname'],
			content: fn( $data
			) => 'Prénom: ' . $data['firstname'] . PHP_EOL . 'Nom: ' . $data['lastname'] . PHP_EOL . 'Email: ' . $data['email'] . PHP_EOL . 'Message:' . PHP_EOL . $data['message'],
		)
		->feedback();
}

add_action( 'admin_post_nopriv_vieuxmoulin_contact_form', 'vieuxmoulin_execute_contact_form' );
add_action( 'admin_post_vieuxmoulin_contact_form', 'vieuxmoulin_execute_contact_form' );

// Travailler avec la session de PHP
function vieuxmoulin_session_flash( string $key, mixed $value ): void {
	if ( ! isset( $_SESSION['vieuxmoulin_flash'] ) ) {
		$_SESSION['vieuxmoulin_flash'] = [];
	}

	$_SESSION['vieuxmoulin_flash'][ $key ] = $value;
}

function vieuxmoulin_session_get( string $key ) {
	if ( isset( $_SESSION['vieuxmoulin_flash'] ) && array_key_exists( $key, $_SESSION['vieuxmoulin_flash'] ) ) {
		// 1. Récupérer la donnée qui a été flash.
		$value = $_SESSION['vieuxmoulin_flash'][ $key ];
		// 2. Supprimer la donnée de la session.
		unset( $_SESSION['vieuxmoulin_flash'][ $key ] );

		// 3. Retourner la donnée récupérée.
		return $value;
	}

	// La donnée n'existait pas dans la session flash, on retourne null.
	return null;
}

function responsive_image( $image, $settings ): bool|string {
	if ( empty( $image ) ) {
		return '';
	}

	$image_id = '';

	if ( is_numeric( $image ) ) {
		// si c'est un nombre, on considère que cela s'agit d'un ID
		$image_id = $image;
	} elseif ( is_array( $image ) && isset( $image['ID'] ) ) {
		// Si c'est un tableau associatif contenant la clé ID, on récupère cet ID
		$image_id = $image['ID'];
	} else {
		return '';
	}

// Récupération des informations de l'image depuis la base de données.
	$alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); // Attribut alt
	$image_post = get_post( $image_id ); // Object WP_Post de l'image
	$title      = $image_post->post_title ?? '';
	$name       = $image_post->post_name ?? '';

// Récupération des URLS et attributs pour l'image en taille "full"
// Wordpress génère automatiquement un srcset basé sur les tailles existantes
	$src    = wp_get_attachment_image_url( $image_id, 'full' );
	$srcset = wp_get_attachment_image_srcset( $image_id, 'full' );
	$sizes  = $settings['custom_sizes'] ?? wp_get_attachment_image_sizes( $image_id, 'full' );

	if ( empty( $settings['custom_sizes'] ) ) {
		$sizes = '{min-width: 800px} 640px, 100dvw';
	}
// Gestion de l'attribut de chargement "lazy" ou "eager" selon les paramètres.
	$lazy = $settings['lazy'] ?? 'eager';

// Gestion des class (si des class sont fournies dans $settings).
	$class = '';
	if ( ! empty( $settings['class'] ) ) {
		$class = is_array( $settings['class'] ) ? implode( ' ', $settings['class'] ) : $settings['class'];
	}

	ob_start();
	?>
	<picture>
		<img
				src="<?= esc_url( $src ) ?>"
				alt="<?= esc_attr( $alt ) ?>"
				loading="<?= esc_attr( $lazy ) ?>"
				srcset="<?= esc_attr( $srcset ) ?>"
				sizes="<?= esc_attr( $sizes ) ?>"
				class="<?= esc_attr( $class ) ?>">
	</picture>
	<?php
	return ob_get_clean();
}

