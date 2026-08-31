<?php
/**
 * Bilingual content helpers and defaults.
 *
 * @package Matro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default public strings. Selected marketing strings can be overridden in MATRO settings.
 *
 * @return array<string,array<string,string>>
 */
function matro_default_strings() {
	return array(
		'nav_about'            => array( 'cs' => 'O společnosti', 'en' => 'About us' ),
		'nav_products'         => array( 'cs' => 'Produkty', 'en' => 'Products' ),
		'nav_contact'          => array( 'cs' => 'Kontakt', 'en' => 'Contact' ),
		'open_menu'            => array( 'cs' => 'Otevřít menu', 'en' => 'Open menu' ),
		'close_menu'           => array( 'cs' => 'Zavřít menu', 'en' => 'Close menu' ),
		'switch_language'      => array( 'cs' => 'Switch to English', 'en' => 'Přepnout do češtiny' ),
		'hero_eyebrow'         => array( 'cs' => 'Velkoobchod s bio potravinami', 'en' => 'Organic food wholesale' ),
		'hero_title'           => array( 'cs' => 'Poctivé bio produkty pro váš obchod.', 'en' => 'Honest organic products for your store.' ),
		'hero_text'            => array( 'cs' => 'Pečlivě vybraný makrobiotický sortiment, přehledné ceny pro prodejny a osobní přístup, na který se můžete spolehnout.', 'en' => 'A carefully selected macrobiotic range, transparent retailer pricing and personal service you can rely on.' ),
		'assortment_eyebrow'   => array( 'cs' => 'Náš sortiment', 'en' => 'Our range' ),
		'assortment_title'     => array( 'cs' => 'Produkty pro zdravý obchod', 'en' => 'Products for a healthier store' ),
		'assortment_text'      => array( 'cs' => 'Aktuální ukázkový výběr. Kompletní sortiment, fotografie a ceny budeme postupně doplňovat.', 'en' => 'A current sample selection. We will gradually add the complete range, product photos and final prices.' ),
		'benefit_one_title'    => array( 'cs' => 'Pečlivě vybraný sortiment', 'en' => 'Carefully selected range' ),
		'benefit_one_text'     => array( 'cs' => 'Produkty vhodné pro prodejny zdravé výživy a specializované obchody.', 'en' => 'Products suited to health food retailers and specialist stores.' ),
		'benefit_two_title'    => array( 'cs' => 'B2B ceny přehledně', 'en' => 'Clear B2B pricing' ),
		'benefit_two_text'     => array( 'cs' => 'Cena za kus bez DPH i s DPH a jasně uvedený minimální odběr.', 'en' => 'Per-item prices excluding and including VAT, with a clear minimum order.' ),
		'benefit_three_title'  => array( 'cs' => 'Osobní domluva', 'en' => 'Personal service' ),
		'benefit_three_text'   => array( 'cs' => 'Objednávku i dostupnost vyřešíte přímo telefonicky nebo e-mailem.', 'en' => 'Discuss orders and availability directly by phone or email.' ),
		'catalog_cta_title'    => array( 'cs' => 'Hledáte konkrétní produkt?', 'en' => 'Looking for a specific product?' ),
		'catalog_cta_text'     => array( 'cs' => 'Napište nám. Aktuální nabídku doplňujeme a rádi ověříme dostupnost požadovaného zboží.', 'en' => 'Get in touch. We are expanding the catalogue and will gladly check current availability.' ),
		'about_eyebrow'        => array( 'cs' => 'O společnosti', 'en' => 'About us' ),
		'about_title'          => array( 'cs' => 'Bio potraviny vybíráme s respektem k přírodě i lidem.', 'en' => 'We select organic food with respect for nature and people.' ),
		'about_lead'           => array( 'cs' => 'MATRO je český dodavatel makrobiotických a bio potravin pro specializované prodejny.', 'en' => 'MATRO is a Czech supplier of macrobiotic and organic food for specialist retailers.' ),
		'about_body_one'       => array( 'cs' => 'Stavíme na dlouhodobých vztazích, osobní komunikaci a sortimentu, který dává smysl zákazníkům hledajícím kvalitní rostlinné potraviny.', 'en' => 'We build on long-term relationships, direct communication and a range that makes sense for customers seeking quality plant-based food.' ),
		'about_body_two'       => array( 'cs' => 'V nabídce najdete cereálie, rýži, těstoviny, nápoje, dochucovadla a další produkty pro každodenní zdravé vaření.', 'en' => 'Our range includes cereals, rice, pasta, drinks, seasonings and other products for healthy everyday cooking.' ),
		'mission'              => array( 'cs' => 'Naše poslání', 'en' => 'Our mission' ),
		'value_one_title'      => array( 'cs' => 'Kvalita před kvantitou', 'en' => 'Quality over quantity' ),
		'value_one_text'       => array( 'cs' => 'Sortiment vybíráme s důrazem na původ, složení a praktické využití.', 'en' => 'We select products with an emphasis on origin, ingredients and practical everyday use.' ),
		'value_two_title'      => array( 'cs' => 'Férové partnerství', 'en' => 'Fair partnerships' ),
		'value_two_text'       => array( 'cs' => 'Zakládáme si na přímé domluvě a srozumitelných obchodních podmínkách.', 'en' => 'We value direct communication and transparent commercial terms.' ),
		'value_three_title'    => array( 'cs' => 'Zkušenost s bio trhem', 'en' => 'Organic market experience' ),
		'value_three_text'     => array( 'cs' => 'Na českém trhu s bio potravinami působíme od roku 2000.', 'en' => 'We have been active in the Czech organic food market since 2000.' ),
		'contact_eyebrow'      => array( 'cs' => 'Kontakt', 'en' => 'Contact' ),
		'contact_title'        => array( 'cs' => 'Pojďme domluvit sortiment pro vaši prodejnu.', 'en' => 'Let’s choose the right range for your store.' ),
		'contact_lead'         => array( 'cs' => 'Ozvěte se nám telefonicky nebo e-mailem. Kontaktní údaje zde budou před spuštěním webu aktualizované.', 'en' => 'Contact us by phone or email. The final contact details will be updated before launch.' ),
		'footer_tagline'       => array( 'cs' => 'Makrobiotické a bio potraviny pro specializované prodejny.', 'en' => 'Macrobiotic and organic food for specialist retailers.' ),
		'phone_label'          => array( 'cs' => 'Telefon', 'en' => 'Phone' ),
		'email_label'          => array( 'cs' => 'E-mail', 'en' => 'Email' ),
		'address_label'        => array( 'cs' => 'Adresa', 'en' => 'Address' ),
		'company_details'      => array( 'cs' => 'Firemní údaje', 'en' => 'Company details' ),
		'search_placeholder'   => array( 'cs' => 'Hledat podle názvu, kategorie nebo značky…', 'en' => 'Search by name, category or brand…' ),
		'sorting'              => array( 'cs' => 'Řazení', 'en' => 'Sort by' ),
		'relevance'            => array( 'cs' => 'Doporučené', 'en' => 'Recommended' ),
		'name_asc'             => array( 'cs' => 'Název A–Z', 'en' => 'Name A–Z' ),
		'price_asc'            => array( 'cs' => 'Cena od nejnižší', 'en' => 'Lowest price' ),
		'price_desc'           => array( 'cs' => 'Cena od nejvyšší', 'en' => 'Highest price' ),
		'categories'           => array( 'cs' => 'Kategorie', 'en' => 'Categories' ),
		'clear_filters'        => array( 'cs' => 'Zrušit výběr', 'en' => 'Clear selection' ),
		'no_products'          => array( 'cs' => 'Žádné produkty neodpovídají zvolenému filtru.', 'en' => 'No products match the selected filters.' ),
		'excluding_vat'        => array( 'cs' => 'bez DPH', 'en' => 'excl. VAT' ),
		'including_vat'        => array( 'cs' => 's DPH', 'en' => 'incl. VAT' ),
		'per_piece'            => array( 'cs' => 'za kus', 'en' => 'per item' ),
		'min_order'            => array( 'cs' => 'Min. odběr', 'en' => 'Min. order' ),
		'pieces'               => array( 'cs' => 'ks', 'en' => 'pcs' ),
		'package'              => array( 'cs' => 'Balení', 'en' => 'Case size' ),
		'detail'               => array( 'cs' => 'Detail produktu', 'en' => 'Product detail' ),
		'quick_view'           => array( 'cs' => 'Rychlý náhled', 'en' => 'Quick view' ),
		'close'                => array( 'cs' => 'Zavřít', 'en' => 'Close' ),
		'back_to_top'          => array( 'cs' => 'Zpět nahoru', 'en' => 'Back to top' ),
		'back_to_catalog'      => array( 'cs' => 'Zpět do katalogu', 'en' => 'Back to catalogue' ),
		'catalog_number'       => array( 'cs' => 'Katalogové číslo', 'en' => 'Catalogue number' ),
		'brand'                => array( 'cs' => 'Značka', 'en' => 'Brand' ),
		'vat'                  => array( 'cs' => 'DPH', 'en' => 'VAT' ),
		'b2b_info'             => array( 'cs' => 'B2B informace', 'en' => 'B2B information' ),
		'composition'          => array( 'cs' => 'Složení', 'en' => 'Ingredients' ),
		'allergens'            => array( 'cs' => 'Alergeny', 'en' => 'Allergens' ),
		'nutrition'            => array( 'cs' => 'Výživové údaje', 'en' => 'Nutrition facts' ),
		'product_documentation'=> array( 'cs' => 'Údaj bude doplněn spolu s finální produktovou dokumentací.', 'en' => 'This information will be added with the final product documentation.' ),
		'contact_product_title'=> array( 'cs' => 'Máte zájem o tento produkt?', 'en' => 'Interested in this product?' ),
		'contact_product_text' => array( 'cs' => 'Ozvěte se nám a domluvíme dostupnost, minimální odběr i podmínky dodání.', 'en' => 'Contact us to discuss availability, minimum order and delivery terms.' ),
		'contact_matro'        => array( 'cs' => 'Kontaktovat Matro', 'en' => 'Contact Matro' ),
		'footer_navigation'    => array( 'cs' => 'Navigace', 'en' => 'Navigation' ),
		'footer_contact'       => array( 'cs' => 'Kontakt', 'en' => 'Contact' ),
		'footer_rights'        => array( 'cs' => 'Všechna práva vyhrazena.', 'en' => 'All rights reserved.' ),
		'sample_data'          => array( 'cs' => 'Ukázková data', 'en' => 'Sample data' ),
		'not_found_title'      => array( 'cs' => 'Stránka nebyla nalezena', 'en' => 'Page not found' ),
		'not_found_text'       => array( 'cs' => 'Zkontrolujte adresu nebo se vraťte do katalogu.', 'en' => 'Check the address or return to the catalogue.' ),
	);
}

/**
 * Return one localized value, preferring an admin override.
 */
function matro_string( $key, $language = 'cs' ) {
	$language = 'en' === $language ? 'en' : 'cs';
	$options  = get_option( 'matro_options', array() );
	$field    = $key . '_' . $language;

	if ( isset( $options[ $field ] ) && '' !== trim( (string) $options[ $field ] ) ) {
		return (string) $options[ $field ];
	}

	$defaults = matro_default_strings();
	return isset( $defaults[ $key ][ $language ] ) ? $defaults[ $key ][ $language ] : $key;
}

/**
 * Print both translations. The frontend script chooses the visible language.
 */
function matro_bilingual( $key, $tag = 'span', $class = '' ) {
	$allowed_tags = array( 'span', 'p', 'h1', 'h2', 'h3', 'strong', 'small' );
	$tag          = in_array( $tag, $allowed_tags, true ) ? $tag : 'span';
	$class_attr   = $class ? ' class="' . esc_attr( $class ) . '"' : '';

	printf(
		'<%1$s data-lang="cs"%2$s>%3$s</%1$s><%1$s data-lang="en"%2$s>%4$s</%1$s>',
		esc_attr( $tag ),
		$class_attr,
		esc_html( matro_string( $key, 'cs' ) ),
		esc_html( matro_string( $key, 'en' ) )
	);
}

/**
 * Read a non-translatable site setting.
 */
function matro_setting( $key, $fallback = '' ) {
	$options = get_option( 'matro_options', array() );
	return isset( $options[ $key ] ) && '' !== (string) $options[ $key ] ? (string) $options[ $key ] : $fallback;
}

/**
 * Print a manually supplied Czech/English pair.
 */
function matro_pair( $czech, $english, $tag = 'span', $class = '' ) {
	$allowed_tags = array( 'span', 'p', 'h1', 'h2', 'h3', 'strong', 'small' );
	$tag          = in_array( $tag, $allowed_tags, true ) ? $tag : 'span';
	$class_attr   = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	$english      = '' !== trim( (string) $english ) ? $english : $czech;

	printf(
		'<%1$s data-lang="cs"%2$s>%3$s</%1$s><%1$s data-lang="en"%2$s>%4$s</%1$s>',
		esc_attr( $tag ),
		$class_attr,
		esc_html( $czech ),
		esc_html( $english )
	);
}

/**
 * Format CZK consistently on server-rendered pages.
 */
function matro_format_price( $value, $language = 'cs' ) {
	$formatted = number_format_i18n( (float) $value, (float) $value === floor( (float) $value ) ? 0 : 2 );
	return 'en' === $language ? 'CZK ' . $formatted : $formatted . ' Kč';
}

/**
 * Return the Czech/English name for a product taxonomy term.
 */
function matro_term_names( $term ) {
	if ( ! $term || is_wp_error( $term ) ) {
		return array( 'cs' => '', 'en' => '' );
	}

	$english = get_term_meta( $term->term_id, 'matro_name_en', true );
	return array(
		'cs' => $term->name,
		'en' => $english ? $english : $term->name,
	);
}

/**
 * Shared editorial introduction used by all main pages.
 */
function matro_page_intro( $eyebrow_key, $title_key, $lead_key, $metric = '', $metric_label = '' ) {
	?>
	<section class="page-intro">
		<div class="page-intro__title">
			<?php matro_bilingual( $eyebrow_key, 'p', 'eyebrow' ); ?>
			<?php matro_bilingual( $title_key, 'h1' ); ?>
		</div>
		<div class="page-intro__lead">
			<?php matro_bilingual( $lead_key, 'p' ); ?>
			<?php if ( $metric && $metric_label ) : ?>
				<div class="page-intro__metric"><strong><?php echo esc_html( $metric ); ?></strong><span><?php echo esc_html( $metric_label ); ?></span></div>
			<?php endif; ?>
		</div>
	</section>
	<?php
}
