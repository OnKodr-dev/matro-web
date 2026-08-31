<?php
/**
 * Not-found page.
 *
 * @package Matro
 */

get_header();
?>
<main id="main-content" class="not-found">
	<div><p class="eyebrow">404</p><?php matro_bilingual( 'not_found_title', 'h1' ); ?><?php matro_bilingual( 'not_found_text', 'p' ); ?><a class="button button--dark" href="<?php echo esc_url( get_post_type_archive_link( 'matro_product' ) ); ?>"><?php matro_bilingual( 'back_to_catalog' ); ?></a></div>
</main>
<?php get_footer(); ?>

