<?php
/**
 * Product archive.
 *
 * @package Matro
 */

get_header();
?>
<main id="main-content" class="site-main">
	<div class="container">
		<?php matro_page_intro( 'hero_eyebrow', 'hero_title', 'hero_text' ); ?>
	</div>
	<?php get_template_part( 'template-parts/catalog' ); ?>
</main>
<?php get_footer(); ?>

