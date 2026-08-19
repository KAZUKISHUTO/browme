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

<?php if ( is_front_page() ) : ?>
<div class="opening" aria-hidden="true">
	<div class="opening__inner">
		<svg class="opening__brow" viewBox="0 0 220 60" width="220" height="60" aria-hidden="true">
			<g class="opening__brow-strokes">
				<path d="M14,44 L20,30" />
				<path d="M28,34 L34,21" />
				<path d="M42,24 L49,12" />
				<path d="M56,18 L63,7" />
				<path d="M69,13.5 L76,3" />
				<path d="M83,11 L89,1" />
				<path d="M97,10 L102,1" />
				<path d="M111,11 L117,2" />
				<path d="M125,14 L132,4" />
				<path d="M139,17 L147,7" />
				<path d="M152,21 L161,12" />
				<path d="M166,25 L176,17" />
				<path d="M180,29 L190,22" />
				<path d="M194,35 L204,29" />
				<path d="M208,40 L216,35" />
			</g>
		</svg>
		<p class="opening__logo">browme</p>
		<p class="opening__sub">EYEBROW SALON</p>
	</div>
</div>
<?php endif; ?>

<header class="site-header">
	<div class="site-header__bar">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo">
			<span class="site-header__logo-mark">browme</span>
		</a>
		<nav class="site-header__actions" aria-label="サイト操作">
			<a href="<?php echo esc_url( home_url( '/#locations' ) ); ?>" class="btn btn-dark">店舗一覧・予約</a>
			<button type="button" class="menu-toggle" data-menu-toggle aria-label="メニューを開く" aria-expanded="false" aria-controls="mobile-nav">
				<span class="menu-toggle__bar"></span>
				<span class="menu-toggle__bar"></span>
				<span class="menu-toggle__bar"></span>
			</button>
		</nav>
	</div>
	<nav class="mobile-nav" id="mobile-nav" data-mobile-nav hidden aria-label="モバイルメニュー">
		<ul class="mobile-nav__list">
			<li><a class="mobile-nav__link" href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><span class="mobile-nav__num">01</span>About Us</a></li>
			<li><a class="mobile-nav__link" href="<?php echo esc_url( home_url( '/#services' ) ); ?>"><span class="mobile-nav__num">02</span>Services</a></li>
			<li><a class="mobile-nav__link" href="<?php echo esc_url( home_url( '/#locations' ) ); ?>"><span class="mobile-nav__num">03</span>Locations</a></li>
			<li><a class="mobile-nav__link" href="<?php echo esc_url( home_url( '/#news' ) ); ?>"><span class="mobile-nav__num">04</span>News</a></li>
			<li><a class="mobile-nav__link" href="<?php echo esc_url( home_url( '/#recruit' ) ); ?>"><span class="mobile-nav__num">05</span>Recruit</a></li>
			<li><a class="mobile-nav__link" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><span class="mobile-nav__num">06</span>Contact</a></li>
		</ul>
	</nav>
</header>
