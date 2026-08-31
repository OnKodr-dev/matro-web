<?php
/**
 * Site header.
 *
 * @package Matro
 */
?><!doctype html>
<html <?php language_attributes(); ?> data-lang="cs">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>try{document.documentElement.dataset.lang=localStorage.getItem('matro-language')==='en'?'en':'cs'}catch(e){document.documentElement.dataset.lang='cs'}</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content">Přejít na obsah</a>
<header class="site-header">
	<div class="site-header__inner">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="MATRO – úvodní stránka">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/matro-logo.svg' ); ?>" alt="MATRO">
		</a>
		<nav class="desktop-nav" aria-label="Hlavní navigace">
			<a class="<?php echo is_page( 'about' ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php matro_bilingual( 'nav_about' ); ?></a>
			<a class="<?php echo is_post_type_archive( 'matro_product' ) || is_singular( 'matro_product' ) || is_front_page() ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'matro_product' ) ); ?>"><?php matro_bilingual( 'nav_products' ); ?></a>
			<a class="<?php echo is_page( 'contact' ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php matro_bilingual( 'nav_contact' ); ?></a>
		</nav>
		<div class="site-header__actions">
			<button class="language-toggle" type="button" data-language-toggle aria-label="Switch to English"><span data-language-code>EN</span></button>
			<button class="menu-toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu">
				<span class="menu-toggle__open" aria-hidden="true">≡</span><span class="menu-toggle__close" aria-hidden="true">×</span>
				<span class="screen-reader-text"><?php matro_bilingual( 'open_menu' ); ?></span>
			</button>
		</div>
	</div>
	<nav class="mobile-nav" id="mobile-menu" data-mobile-menu aria-label="Mobilní navigace" hidden>
		<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php matro_bilingual( 'nav_about' ); ?></a>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'matro_product' ) ); ?>"><?php matro_bilingual( 'nav_products' ); ?></a>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php matro_bilingual( 'nav_contact' ); ?></a>
	</nav>
</header>

