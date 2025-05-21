<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php bloginfo( 'name' );
		wp_title( $sep = '·' ) ?></title>
	<link rel="stylesheet" href="<?= vieuxmoulin_asset( 'css/main.css' ); ?>">
	<script src="<?= vieuxmoulin_asset( 'js/main.js' ) ?>"></script>
	<?php wp_head(); ?>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
	<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
	/>

</head>
<body class="body">
<?php wp_body_open(); ?>
<header class="header">
	<h1 class="hidden"><?php bloginfo( 'name' ); ?></h1>
	<nav class="nav">
		<h2 class="hidden">Main navigation</h2>

	</nav>
</header>
<main class="main">
	<div class="content">

