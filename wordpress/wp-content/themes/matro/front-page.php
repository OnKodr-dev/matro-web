<?php
/**
 * Home page: catalogue and company introduction.
 *
 * @package Matro
 */

get_header();
?>
<main id="main-content" class="site-main">
	<div class="container">
		<?php matro_page_intro( 'hero_eyebrow', 'hero_title', 'hero_text' ); ?>
		<section class="feature-grid" aria-label="Výhody spolupráce">
			<?php foreach ( array( 'one', 'two', 'three' ) as $number ) : ?>
				<article>
					<?php matro_bilingual( 'benefit_' . $number . '_title', 'h2' ); ?>
					<?php matro_bilingual( 'benefit_' . $number . '_text', 'p' ); ?>
				</article>
			<?php endforeach; ?>
		</section>
	</div>
	<?php get_template_part( 'template-parts/catalog' ); ?>
</main>
<?php get_footer(); ?>

