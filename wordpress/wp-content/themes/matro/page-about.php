<?php
/**
 * About page.
 *
 * @package Matro
 */

get_header();
$company_name = matro_setting( 'company_name', 'MATRO Praha, s.r.o.' );
?>
<main id="main-content" class="site-main">
	<div class="container">
		<?php matro_page_intro( 'about_eyebrow', 'about_title', 'about_lead' ); ?>
		<section class="editorial-section">
			<div><p class="eyebrow"><?php echo esc_html( $company_name ); ?></p><?php matro_bilingual( 'mission', 'h2' ); ?></div>
			<div class="editorial-section__body"><?php matro_bilingual( 'about_body_one', 'p' ); ?><?php matro_bilingual( 'about_body_two', 'p' ); ?></div>
		</section>
		<section class="value-grid">
			<?php foreach ( array( 'one', 'two', 'three' ) as $number ) : ?>
				<article><?php matro_bilingual( 'value_' . $number . '_title', 'h2' ); ?><?php matro_bilingual( 'value_' . $number . '_text', 'p' ); ?></article>
			<?php endforeach; ?>
		</section>
	</div>
</main>
<?php get_footer(); ?>

