<?php
/**
 * Site footer.
 *
 * @package Matro
 */

$company_name = matro_setting( 'company_name', 'MATRO Praha, s.r.o.' );
$phone        = matro_setting( 'phone', '+420 XXX XXX XXX' );
$email        = matro_setting( 'email', 'obchod@matro.cz' );
$address_cs   = matro_setting( 'address_cs', 'Adresa bude doplněna' );
$address_en   = matro_setting( 'address_en', 'Address to be confirmed' );
?>
<footer class="site-footer">
	<div class="container">
		<div class="site-footer__grid">
			<div>
				<img class="site-footer__logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/matro-logo.svg' ); ?>" alt="MATRO">
				<?php matro_bilingual( 'footer_tagline', 'p', 'site-footer__tagline' ); ?>
			</div>
			<div>
				<?php matro_bilingual( 'footer_navigation', 'h2' ); ?>
				<nav class="site-footer__nav">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php matro_bilingual( 'nav_about' ); ?></a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'matro_product' ) ); ?>"><?php matro_bilingual( 'nav_products' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php matro_bilingual( 'nav_contact' ); ?></a>
				</nav>
			</div>
			<div>
				<?php matro_bilingual( 'footer_contact', 'h2' ); ?>
				<div class="site-footer__contact">
					<p><?php echo esc_html( $phone ); ?></p>
					<p><?php echo esc_html( $email ); ?></p>
					<?php matro_pair( $address_cs, $address_en, 'p' ); ?>
				</div>
			</div>
		</div>
		<div class="site-footer__bottom">
			<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $company_name ); ?> · <?php matro_bilingual( 'footer_rights' ); ?></p>
			<a href="<?php echo esc_url( admin_url() ); ?>">Administrace</a>
		</div>
	</div>
</footer>
<button class="back-to-top" type="button" data-back-to-top title="Zpět nahoru" aria-label="Zpět nahoru">↑</button>
<?php wp_footer(); ?>
</body>
</html>

