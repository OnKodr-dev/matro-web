<?php
/**
 * MATRO settings and optional demo-data importer.
 *
 * @package Matro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fields exposed on the MATRO settings page.
 *
 * @return array<string,array<string,mixed>>
 */
function matro_admin_sections() {
	return array(
		'contact' => array(
			'title'  => 'Firma a kontakty',
			'fields' => array(
				'company_name'       => array( 'label' => 'Název společnosti', 'default' => 'MATRO Praha, s.r.o.' ),
				'company_id'         => array( 'label' => 'IČO', 'default' => '27564541' ),
				'company_vat'        => array( 'label' => 'DIČ / VAT ID', 'default' => 'CZ27564541' ),
				'phone'              => array( 'label' => 'Telefon', 'default' => '+420 XXX XXX XXX' ),
				'email'              => array( 'label' => 'E-mail', 'default' => 'obchod@matro.cz', 'type' => 'email' ),
				'address_cs'         => array( 'label' => 'Adresa – česky', 'default' => 'Adresa bude doplněna' ),
				'address_en'         => array( 'label' => 'Adresa – anglicky', 'default' => 'Address to be confirmed' ),
				'availability_cs'    => array( 'label' => 'Dostupnost – česky', 'default' => 'Po–Pá, čas bude doplněn' ),
				'availability_en'    => array( 'label' => 'Dostupnost – anglicky', 'default' => 'Mon–Fri, hours to be confirmed' ),
				'address_note_cs'    => array( 'label' => 'Poznámka k adrese – česky', 'default' => 'Praha, Česká republika' ),
				'address_note_en'    => array( 'label' => 'Poznámka k adrese – anglicky', 'default' => 'Prague, Czech Republic' ),
			),
		),
		'catalog' => array(
			'title' => 'Úvod a katalog',
			'keys'  => array(
				'hero_eyebrow'        => 'Štítek hlavního nadpisu',
				'hero_title'          => 'Hlavní nadpis',
				'hero_text'           => 'Úvodní text',
				'benefit_one_title'   => 'Výhoda 1 – nadpis',
				'benefit_one_text'    => 'Výhoda 1 – text',
				'benefit_two_title'   => 'Výhoda 2 – nadpis',
				'benefit_two_text'    => 'Výhoda 2 – text',
				'benefit_three_title' => 'Výhoda 3 – nadpis',
				'benefit_three_text'  => 'Výhoda 3 – text',
				'assortment_eyebrow'  => 'Štítek katalogu',
				'assortment_title'    => 'Nadpis katalogu',
				'assortment_text'     => 'Text katalogu',
				'catalog_cta_title'   => 'Výzva – nadpis',
				'catalog_cta_text'    => 'Výzva – text',
			),
		),
		'about' => array(
			'title' => 'O společnosti',
			'keys'  => array(
				'about_eyebrow'     => 'Štítek stránky',
				'about_title'       => 'Hlavní nadpis',
				'about_lead'        => 'Úvodní text',
				'mission'           => 'Nadpis poslání',
				'about_body_one'    => 'Text 1',
				'about_body_two'    => 'Text 2',
				'value_one_title'   => 'Hodnota 1 – nadpis',
				'value_one_text'    => 'Hodnota 1 – text',
				'value_two_title'   => 'Hodnota 2 – nadpis',
				'value_two_text'    => 'Hodnota 2 – text',
				'value_three_title' => 'Hodnota 3 – nadpis',
				'value_three_text'  => 'Hodnota 3 – text',
			),
		),
		'contact_page' => array(
			'title' => 'Kontaktní stránka a patička',
			'keys'  => array(
				'contact_eyebrow' => 'Štítek kontaktní stránky',
				'contact_title'   => 'Hlavní nadpis kontaktu',
				'contact_lead'    => 'Úvodní text kontaktu',
				'footer_tagline'  => 'Text pod logem v patičce',
			),
		),
	);
}

/**
 * Add the MATRO administration page.
 */
function matro_add_admin_menu() {
	add_menu_page(
		'MATRO – nastavení webu',
		'MATRO',
		'manage_options',
		'matro-settings',
		'matro_render_settings_page',
		'dashicons-admin-site-alt3',
		21
	);
}
add_action( 'admin_menu', 'matro_add_admin_menu' );

/**
 * Register and sanitize the single theme option.
 */
function matro_register_settings() {
	register_setting(
		'matro_settings_group',
		'matro_options',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'matro_sanitize_options',
			'default'           => array(),
		)
	);
}
add_action( 'admin_init', 'matro_register_settings' );

/**
 * Accept only known fields and suitable scalar values.
 */
function matro_sanitize_options( $input ) {
	$output = array();
	$input  = is_array( $input ) ? $input : array();

	foreach ( matro_admin_sections() as $section ) {
		if ( isset( $section['fields'] ) ) {
			foreach ( $section['fields'] as $key => $field ) {
				if ( ! isset( $input[ $key ] ) ) {
					continue;
				}
				$output[ $key ] = isset( $field['type'] ) && 'email' === $field['type']
					? sanitize_email( $input[ $key ] )
					: sanitize_text_field( $input[ $key ] );
			}
		}

		if ( isset( $section['keys'] ) ) {
			foreach ( $section['keys'] as $key => $label ) {
				foreach ( array( 'cs', 'en' ) as $language ) {
					$field = $key . '_' . $language;
					if ( isset( $input[ $field ] ) ) {
						$output[ $field ] = sanitize_textarea_field( $input[ $field ] );
					}
				}
			}
		}
	}

	return $output;
}

/**
 * Settings screen with bilingual fields and a separate seed-data action.
 */
function matro_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$options = get_option( 'matro_options', array() );
	$seeded  = isset( $_GET['matro_seeded'] ) ? absint( $_GET['matro_seeded'] ) : null;
	?>
	<div class="wrap matro-settings-wrap">
		<h1>MATRO – nastavení webu</h1>
		<p>Zde spravujete společné kontakty a hlavní české i anglické texty. Produkty jsou v samostatné nabídce <strong>Produkty</strong>.</p>
		<?php if ( null !== $seeded ) : ?>
			<div class="notice notice-success is-dismissible"><p>Import dokončen. Nově vytvořené produkty: <?php echo esc_html( $seeded ); ?>.</p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'matro_settings_group' ); ?>
			<?php foreach ( matro_admin_sections() as $section ) : ?>
				<section class="matro-settings-card">
					<h2><?php echo esc_html( $section['title'] ); ?></h2>
					<?php if ( isset( $section['fields'] ) ) : ?>
						<div class="matro-settings-grid">
							<?php foreach ( $section['fields'] as $key => $field ) : ?>
								<?php $value = isset( $options[ $key ] ) ? $options[ $key ] : $field['default']; ?>
								<label>
									<strong><?php echo esc_html( $field['label'] ); ?></strong>
									<input type="<?php echo esc_attr( isset( $field['type'] ) ? $field['type'] : 'text' ); ?>" name="matro_options[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>">
								</label>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( isset( $section['keys'] ) ) : ?>
						<div class="matro-translation-table">
							<div class="matro-translation-heading"><span>Položka</span><span>Čeština</span><span>Angličtina</span></div>
							<?php foreach ( $section['keys'] as $key => $label ) : ?>
								<div class="matro-translation-row">
									<strong><?php echo esc_html( $label ); ?></strong>
									<?php foreach ( array( 'cs', 'en' ) as $language ) : ?>
										<?php
										$field = $key . '_' . $language;
										$value = isset( $options[ $field ] ) ? $options[ $field ] : matro_string( $key, $language );
										?>
										<textarea name="matro_options[<?php echo esc_attr( $field ); ?>]" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
									<?php endforeach; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</section>
			<?php endforeach; ?>
			<?php submit_button( 'Uložit nastavení' ); ?>
		</form>

		<section class="matro-settings-card">
			<h2>Ukázkové produkty</h2>
			<p>Import vytvoří pouze chybějící ukázkové produkty a kategorie. Existující položky nepřepíše.</p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="matro_seed_products">
				<?php wp_nonce_field( 'matro_seed_products' ); ?>
				<?php submit_button( 'Importovat ukázkové produkty', 'secondary', 'submit', false ); ?>
			</form>
		</section>
	</div>
	<style>
		.matro-settings-wrap{max-width:1400px}.matro-settings-card{background:#fff;border:1px solid #dcdcde;border-radius:12px;margin:20px 0;padding:22px}.matro-settings-card h2{margin-top:0}.matro-settings-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.matro-settings-grid label{display:flex;flex-direction:column;gap:6px}.matro-settings-grid input{width:100%}.matro-translation-heading,.matro-translation-row{display:grid;grid-template-columns:190px 1fr 1fr;gap:12px;align-items:start}.matro-translation-heading{border-bottom:1px solid #dcdcde;color:#646970;font-weight:700;padding:8px 0}.matro-translation-row{border-bottom:1px solid #f0f0f1;padding:12px 0}.matro-translation-row textarea{width:100%}@media(max-width:900px){.matro-settings-grid{grid-template-columns:1fr}.matro-translation-heading{display:none}.matro-translation-row{grid-template-columns:1fr}.matro-translation-row textarea:before{content:''}}
	</style>
	<?php
}

/**
 * Demo category definitions.
 */
function matro_demo_categories() {
	return array(
		'Cereálie a zrna' => 'Cereals and grains',
		'Těstoviny' => 'Pasta and noodles',
		'Snídaňové cereálie' => 'Breakfast cereals',
		'Rýžové keksy' => 'Rice cakes',
		'Pochutiny' => 'Snacks',
		'Obilné kávové náhražky' => 'Cereal coffee alternatives',
		'Nápoje' => 'Drinks',
		'Dezerty' => 'Desserts',
		'Polévky' => 'Soups',
		'Sůl, oleje, koření a dochucovadla' => 'Salt, oils, spices and seasonings',
		'Biopiva, konopné produkty, nealkobiopivo' => 'Organic beer, hemp products and alcohol-free beer',
	);
}

/**
 * Demo product payload mirroring the current prototype.
 */
function matro_demo_products() {
	return array(
		array( 'id'=>'c-101','sku'=>'00405','slug'=>'ryze-kratkozrnna-1kg','name'=>'Rýže krátkozrnná 1 kg','name_en'=>'Short-grain rice 1 kg','price'=>52,'vat'=>12,'package'=>'6 × 1 kg','min'=>6,'category'=>'Cereálie a zrna','tag'=>'Rýže','tag_en'=>'Rice','brand'=>'LIMA','image'=>'photo-1586201375761-83865001e31c','description'=>'Krátkozrnná rýže vhodná pro přípravu rizota, kaší a každodenní makrobiotické kuchyně.','description_en'=>'Short-grain rice suited to risotto, porridge and everyday macrobiotic cooking.' ),
		array( 'id'=>'c-102','sku'=>'00805','slug'=>'ryze-dlouhozrnna-1kg','name'=>'Rýže dlouhozrnná 1 kg','name_en'=>'Long-grain rice 1 kg','price'=>55,'vat'=>12,'package'=>'6 × 1 kg','min'=>6,'category'=>'Cereálie a zrna','tag'=>'Rýže','tag_en'=>'Rice','brand'=>'LIMA','image'=>'photo-1536304993881-ff6e9eefa2a6','description'=>'Univerzální dlouhozrnná rýže s lehkou, sypkou strukturou po uvaření.','description_en'=>'Versatile long-grain rice with a light, fluffy texture after cooking.' ),
		array( 'id'=>'c-103','sku'=>'00716','slug'=>'ryze-basmati-500g','name'=>'Rýže Basmati 500 g','name_en'=>'Basmati rice 500 g','price'=>62,'vat'=>12,'package'=>'6 × 500 g','min'=>6,'category'=>'Cereálie a zrna','tag'=>'Rýže','tag_en'=>'Rice','brand'=>'LIMA','image'=>'photo-1596797038530-2c107229654b','description'=>'Aromatická rýže Basmati s jemnou chutí pro lehká jídla a přílohy.','description_en'=>'Aromatic Basmati rice with a delicate flavour for light meals and side dishes.' ),
		array( 'id'=>'c-104','sku'=>'00766','slug'=>'ryze-cervena-celozrnna-500g','name'=>'Rýže červená celozrnná 500 g','name_en'=>'Wholegrain red rice 500 g','price'=>74,'vat'=>12,'package'=>'6 × 500 g','min'=>6,'category'=>'Cereálie a zrna','tag'=>'Rýže','tag_en'=>'Rice','brand'=>'LIMA','image'=>'photo-1516684669134-de6f7c473a2a','description'=>'Výrazná celozrnná rýže s oříškovou chutí a pevnější strukturou.','description_en'=>'Distinctive wholegrain rice with a nutty flavour and pleasantly firm texture.' ),
		array( 'id'=>'c-105','sku'=>'00946','slug'=>'ryze-divoka-mix-500g','name'=>'Rýže divoká mix 500 g','name_en'=>'Wild rice mix 500 g','price'=>65,'vat'=>12,'package'=>'6 × 500 g','min'=>6,'category'=>'Cereálie a zrna','tag'=>'Rýže','tag_en'=>'Rice','brand'=>'LIMA','image'=>'photo-1603105037880-880cd4edfb0d','description'=>'Barevná směs divoké a celozrnné rýže pro atraktivní přílohy a saláty.','description_en'=>'A colourful mix of wild and wholegrain rice for attractive sides and salads.' ),
		array( 'id'=>'c-201','sku'=>'07036','slug'=>'vojteska-alfalfa-100g','name'=>'Vojtěška (alfalfa) 100 g','name_en'=>'Alfalfa sprouting seeds 100 g','price'=>56,'vat'=>12,'package'=>'5 × 100 g','min'=>5,'category'=>'Cereálie a zrna','tag'=>'Semena ke klíčení','tag_en'=>'Sprouting seeds','brand'=>'LIMA','image'=>'photo-1530968464165-7a1861cbaf9f','description'=>'Semena vojtěšky určená pro domácí klíčení a čerstvé zelené výhonky.','description_en'=>'Alfalfa seeds for home sprouting and fresh green shoots.' ),
		array( 'id'=>'c-202','sku'=>'07066','slug'=>'rericha-75g','name'=>'Řeřicha 75 g','name_en'=>'Garden cress seeds 75 g','price'=>56,'vat'=>12,'package'=>'5 × 75 g','min'=>5,'category'=>'Cereálie a zrna','tag'=>'Semena ke klíčení','tag_en'=>'Sprouting seeds','brand'=>'LIMA','image'=>'photo-1585320806297-9794b3e4eeae','description'=>'Semena řeřichy pro rychlé domácí klíčení s typickou svěží chutí.','description_en'=>'Garden cress seeds for quick home sprouting and a characteristic fresh flavour.' ),
		array( 'id'=>'c-203','sku'=>'07096','slug'=>'rukola-70g','name'=>'Rukola 70 g','name_en'=>'Rocket sprouting seeds 70 g','price'=>56,'vat'=>12,'package'=>'5 × 70 g','min'=>5,'category'=>'Cereálie a zrna','tag'=>'Semena ke klíčení','tag_en'=>'Sprouting seeds','brand'=>'LIMA','image'=>'photo-1501004318641-b39e6451bec6','description'=>'Semena rukoly pro pikantní klíčky vhodné do salátů a studené kuchyně.','description_en'=>'Rocket seeds for peppery sprouts, ideal for salads and cold dishes.' ),
		array( 'id'=>'t-101','sku'=>'12015','slug'=>'kamut-spaghetti-500g','name'=>'Kamut Spaghetti 500 g','name_en'=>'Kamut spaghetti 500 g','price'=>55,'vat'=>12,'package'=>'6 × 500 g','min'=>6,'category'=>'Těstoviny','tag'=>'Cereální těstoviny','tag_en'=>'Cereal pasta','brand'=>'LIMA','image'=>'photo-1551892374-ecf8754cf8b0','description'=>'Špagety z kamutové mouky s plnou obilnou chutí.','description_en'=>'Spaghetti made from Kamut flour with a full, wheaty flavour.' ),
		array( 'id'=>'t-102','sku'=>'12025','slug'=>'kamut-penne-500g','name'=>'Kamut Penne 500 g','name_en'=>'Kamut penne 500 g','price'=>60,'vat'=>12,'package'=>'6 × 500 g','min'=>6,'category'=>'Těstoviny','tag'=>'Cereální těstoviny','tag_en'=>'Cereal pasta','brand'=>'LIMA','image'=>'photo-1473093295043-cdd812d0e601','description'=>'Kamutové penne vhodné k omáčkám, zelenině i zapékání.','description_en'=>'Kamut penne suited to sauces, vegetables and baked pasta dishes.' ),
		array( 'id'=>'t-103','sku'=>'12035','slug'=>'kamut-tagliatelle-500g','name'=>'Kamut Tagliatelle 500 g','name_en'=>'Kamut tagliatelle 500 g','price'=>60,'vat'=>12,'package'=>'6 × 500 g','min'=>6,'category'=>'Těstoviny','tag'=>'Cereální těstoviny','tag_en'=>'Cereal pasta','brand'=>'LIMA','image'=>'photo-1556761223-4c4282c73f77','description'=>'Široké kamutové nudle pro výraznější omáčky a zeleninová jídla.','description_en'=>'Wide Kamut ribbons for richer sauces and vegetable dishes.' ),
		array( 'id'=>'t-201','sku'=>'12510','slug'=>'udon-250g','name'=>'Udon 250 g','name_en'=>'Udon noodles 250 g','price'=>64,'vat'=>12,'package'=>'6 × 250 g','min'=>6,'category'=>'Těstoviny','tag'=>'Japonské těstoviny','tag_en'=>'Japanese noodles','brand'=>'LIMA','image'=>'photo-1569718212165-3a8278d5f624','description'=>'Tradiční japonské nudle Udon vhodné do vývarů i zeleninových směsí.','description_en'=>'Traditional Japanese Udon noodles for broths and vegetable dishes.' ),
		array( 'id'=>'t-202','sku'=>'12520','slug'=>'soba-100-250g','name'=>'Soba 100% 250 g','name_en'=>'100% Soba noodles 250 g','price'=>128.6,'vat'=>12,'package'=>'12 × 250 g','min'=>12,'category'=>'Těstoviny','tag'=>'Japonské těstoviny','tag_en'=>'Japanese noodles','brand'=>'LIMA','image'=>'photo-1612929633738-8fe44f7ec841','description'=>'Pohankové nudle Soba s výraznou chutí pro teplou i studenou kuchyni.','description_en'=>'Buckwheat Soba noodles with a distinctive flavour for hot and cold dishes.' ),
	);
}

/**
 * Import sample products once, retaining all administrator edits.
 */
function matro_seed_products() {
	foreach ( matro_demo_categories() as $name => $english ) {
		$term = term_exists( $name, 'matro_product_category' );
		if ( ! $term ) {
			$term = wp_insert_term( $name, 'matro_product_category' );
		}
		if ( ! is_wp_error( $term ) ) {
			$term_id = is_array( $term ) ? $term['term_id'] : $term;
			update_term_meta( $term_id, 'matro_name_en', $english );
		}
	}

	$created = 0;
	foreach ( matro_demo_products() as $product ) {
		$existing = get_posts(
			array(
				'post_type'      => 'matro_product',
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'meta_key'       => '_matro_seed_id',
				'meta_value'     => $product['id'],
				'fields'         => 'ids',
			)
		);
		if ( $existing ) {
			continue;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'matro_product',
				'post_status' => 'publish',
				'post_title'  => $product['name'],
				'post_name'   => $product['slug'],
			)
		);
		if ( is_wp_error( $post_id ) ) {
			continue;
		}

		$meta = array(
			'_matro_seed_id'        => $product['id'],
			'_matro_name_en'        => $product['name_en'],
			'_matro_sku'            => $product['sku'],
			'_matro_brand'          => $product['brand'],
			'_matro_price_ex_vat'   => $product['price'],
			'_matro_vat_rate'       => $product['vat'],
			'_matro_package_cs'     => $product['package'],
			'_matro_package_en'     => $product['package'],
			'_matro_min_order'      => $product['min'],
			'_matro_description_cs' => $product['description'],
			'_matro_description_en' => $product['description_en'],
			'_matro_image_url'      => 'https://images.unsplash.com/' . $product['image'] . '?auto=format&fit=crop&w=1200&q=82',
		);
		foreach ( $meta as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}

		wp_set_object_terms( $post_id, $product['category'], 'matro_product_category' );
		$tag = term_exists( $product['tag'], 'matro_product_tag' );
		if ( ! $tag ) {
			$tag = wp_insert_term( $product['tag'], 'matro_product_tag' );
		}
		if ( ! is_wp_error( $tag ) ) {
			$tag_id = is_array( $tag ) ? $tag['term_id'] : $tag;
			update_term_meta( $tag_id, 'matro_name_en', $product['tag_en'] );
			wp_set_object_terms( $post_id, array( (int) $tag_id ), 'matro_product_tag' );
		}
		++$created;
	}

	return $created;
}

/**
 * Authorized browser endpoint for the demo importer.
 */
function matro_handle_seed_products() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Nemáte oprávnění k této akci.', 'matro' ) );
	}
	check_admin_referer( 'matro_seed_products' );

	$created  = matro_seed_products();
	$redirect = add_query_arg(
		array(
			'page'         => 'matro-settings',
			'matro_seeded' => $created,
		),
		admin_url( 'admin.php' )
	);
	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'admin_post_matro_seed_products', 'matro_handle_seed_products' );
