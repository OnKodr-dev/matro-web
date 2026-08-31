<?php
/**
 * Contact page.
 *
 * @package Matro
 */

get_header();
$company_name = matro_setting( 'company_name', 'MATRO Praha, s.r.o.' );
$phone        = matro_setting( 'phone', '+420 XXX XXX XXX' );
$email        = matro_setting( 'email', 'obchod@matro.cz' );
$address_cs   = matro_setting( 'address_cs', 'Adresa bude doplněna' );
$address_en   = matro_setting( 'address_en', 'Address to be confirmed' );
$availability_cs = matro_setting( 'availability_cs', 'Po–Pá, čas bude doplněn' );
$availability_en = matro_setting( 'availability_en', 'Mon–Fri, hours to be confirmed' );
$address_note_cs = matro_setting( 'address_note_cs', 'Praha, Česká republika' );
$address_note_en = matro_setting( 'address_note_en', 'Prague, Czech Republic' );
?>
<main id="main-content" class="site-main">
	<div class="container">
		<?php matro_page_intro( 'contact_eyebrow', 'contact_title', 'contact_lead', 'B2B', $company_name ); ?>
		<section class="contact-grid">
			<article><?php matro_bilingual( 'phone_label', 'h2' ); ?><p class="contact-grid__value"><?php echo esc_html( $phone ); ?></p><?php matro_pair( $availability_cs, $availability_en, 'p', 'contact-grid__note' ); ?></article>
			<article><?php matro_bilingual( 'email_label', 'h2' ); ?><p class="contact-grid__value"><a href="mailto:<?php echo esc_attr( sanitize_email( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></p><p class="contact-grid__note">B2B / wholesale</p></article>
			<article><?php matro_bilingual( 'address_label', 'h2' ); ?><?php matro_pair( $address_cs, $address_en, 'p', 'contact-grid__value' ); ?><?php matro_pair( $address_note_cs, $address_note_en, 'p', 'contact-grid__note' ); ?></article>
		</section>
		<section class="company-details">
			<div><?php matro_bilingual( 'company_details', 'p', 'eyebrow' ); ?><h2><?php echo esc_html( $company_name ); ?></h2></div>
			<dl>
				<div><dt>IČO</dt><dd><?php echo esc_html( matro_setting( 'company_id', '27564541' ) ); ?></dd></div>
				<div><dt>DIČ / VAT ID</dt><dd><?php echo esc_html( matro_setting( 'company_vat', 'CZ27564541' ) ); ?></dd></div>
				<div><dt>Web</dt><dd><?php echo esc_html( wp_parse_url( home_url( '/' ), PHP_URL_HOST ) ); ?></dd></div>
			</dl>
		</section>
	</div>
</main>
<?php get_footer(); ?>
