<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="site-header__bar">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo">
			<span class="site-header__logo-mark">browme</span>
		</a>
		<nav class="site-header__actions" aria-label="サイト操作">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__back-link">← コーポレートサイト</a>
		</nav>
	</div>
</header>
