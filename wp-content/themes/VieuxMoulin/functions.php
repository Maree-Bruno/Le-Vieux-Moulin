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


