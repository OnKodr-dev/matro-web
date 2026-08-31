<?php
/**
 * Product content model and editor fields.
 *
 * @package Matro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register products and their two taxonomies.
 */
function matro_register_content_types() {
	register_post_type(
		'matro_product',
		array(
			'labels' => array(
				'name'               => 'Produkty',
				'singular_name'      => 'Produkt',
				'add_new'            => 'Přidat produkt',
				'add_new_item'       => 'Přidat nový produkt',
				'edit_item'          => 'Upravit produkt',
				'new_item'           => 'Nový produkt',
				'view_item'          => 'Zobrazit produkt',
				'search_items'       => 'Hledat produkty',
				'not_found'          => 'Nebyly nalezeny žádné produkty',
				'not_found_in_trash' => 'V koši nejsou žádné produkty',
				'all_items'          => 'Všechny produkty',
				'menu_name'          => 'Produkty',
			),
			'public'             => true,
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-carrot',
			'supports'           => array( 'title', 'thumbnail', 'revisions' ),
			'has_archive'        => 'products',
			'rewrite'            => array( 'slug' => 'product', 'with_front' => false ),
			'menu_position'      => 20,
			'publicly_queryable' => true,
		)
	);

	register_taxonomy(
		'matro_product_category',
		'matro_product',
		array(
			'labels' => array(
				'name'          => 'Kategorie produktů',
				'singular_name' => 'Kategorie produktu',
				'add_new_item'  => 'Přidat kategorii',
				'edit_item'     => 'Upravit kategorii',
			),
			'public'            => true,
			'show_in_rest'      => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'product-category' ),
		)
	);

	register_taxonomy(
		'matro_product_tag',
		'matro_product',
		array(
			'labels' => array(
				'name'          => 'Štítky produktů',
				'singular_name' => 'Štítek produktu',
			),
			'public'            => true,
			'show_in_rest'      => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'product-tag' ),
		)
	);
}
add_action( 'init', 'matro_register_content_types' );

/**
 * Product meta definitions used by the editor and save handler.
 */
function matro_product_fields() {
	return array(
		'_matro_name_en'        => array( 'label' => 'Název produktu – anglicky', 'type' => 'text' ),
		'_matro_sku'            => array( 'label' => 'Katalogové číslo', 'type' => 'text' ),
		'_matro_brand'          => array( 'label' => 'Značka', 'type' => 'text' ),
		'_matro_price_ex_vat'   => array( 'label' => 'Cena za kus bez DPH (Kč)', 'type' => 'number', 'step' => '0.01', 'min' => '0' ),
		'_matro_vat_rate'       => array( 'label' => 'DPH (%)', 'type' => 'number', 'step' => '1', 'min' => '0', 'default' => '12' ),
		'_matro_package_cs'     => array( 'label' => 'Obchodní balení – česky', 'type' => 'text' ),
		'_matro_package_en'     => array( 'label' => 'Obchodní balení – anglicky', 'type' => 'text' ),
		'_matro_min_order'      => array( 'label' => 'Minimální odběr (ks)', 'type' => 'number', 'step' => '1', 'min' => '1', 'default' => '1' ),
		'_matro_description_cs' => array( 'label' => 'Krátký popis – česky', 'type' => 'textarea' ),
		'_matro_description_en' => array( 'label' => 'Krátký popis – anglicky', 'type' => 'textarea' ),
		'_matro_composition_cs' => array( 'label' => 'Složení – česky', 'type' => 'textarea' ),
		'_matro_composition_en' => array( 'label' => 'Složení – anglicky', 'type' => 'textarea' ),
		'_matro_allergens_cs'   => array( 'label' => 'Alergeny – česky', 'type' => 'textarea' ),
		'_matro_allergens_en'   => array( 'label' => 'Alergeny – anglicky', 'type' => 'textarea' ),
		'_matro_nutrition_cs'   => array( 'label' => 'Výživové údaje – česky', 'type' => 'textarea' ),
		'_matro_nutrition_en'   => array( 'label' => 'Výživové údaje – anglicky', 'type' => 'textarea' ),
		'_matro_image_url'      => array( 'label' => 'Externí URL obrázku (záložní)', 'type' => 'url' ),
	);
}

/**
 * Add the product details editor panel.
 */
function matro_add_product_meta_boxes() {
	add_meta_box(
		'matro-product-details',
		'Údaje produktu',
		'matro_render_product_meta_box',
		'matro_product',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'matro_add_product_meta_boxes' );

/**
 * Render all product fields without an external fields plugin.
 */
function matro_render_product_meta_box( $post ) {
	wp_nonce_field( 'matro_save_product', 'matro_product_nonce' );
	$fields = matro_product_fields();
	?>
	<p><strong>Český název</strong> se zadává do hlavního titulku nahoře. Hlavní fotografii nastavte v panelu „Náhledový obrázek“.</p>
	<div class="matro-admin-grid">
		<?php foreach ( $fields as $key => $field ) : ?>
			<?php
			$value = get_post_meta( $post->ID, $key, true );
			if ( '' === $value && isset( $field['default'] ) ) {
				$value = $field['default'];
			}
			?>
			<label class="<?php echo 'textarea' === $field['type'] ? 'matro-admin-wide' : ''; ?>">
				<strong><?php echo esc_html( $field['label'] ); ?></strong>
				<?php if ( 'textarea' === $field['type'] ) : ?>
					<textarea name="<?php echo esc_attr( $key ); ?>" rows="4"><?php echo esc_textarea( $value ); ?></textarea>
				<?php else : ?>
					<input
						type="<?php echo esc_attr( $field['type'] ); ?>"
						name="<?php echo esc_attr( $key ); ?>"
						value="<?php echo esc_attr( $value ); ?>"
						<?php echo isset( $field['step'] ) ? ' step="' . esc_attr( $field['step'] ) . '"' : ''; ?>
						<?php echo isset( $field['min'] ) ? ' min="' . esc_attr( $field['min'] ) . '"' : ''; ?>
					/>
				<?php endif; ?>
			</label>
		<?php endforeach; ?>
	</div>
	<style>
		.matro-admin-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.matro-admin-grid label{display:flex;flex-direction:column;gap:6px}.matro-admin-grid input,.matro-admin-grid textarea{width:100%}.matro-admin-wide{grid-column:1/-1}@media(max-width:782px){.matro-admin-grid{grid-template-columns:1fr}}
	</style>
	<?php
}

/**
 * Save product details safely.
 */
function matro_save_product_meta( $post_id ) {
	if ( ! isset( $_POST['matro_product_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['matro_product_nonce'] ) ), 'matro_save_product' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( matro_product_fields() as $key => $field ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}

		$raw = wp_unslash( $_POST[ $key ] );
		switch ( $field['type'] ) {
			case 'number':
				$value = is_numeric( $raw ) ? (string) max( 0, (float) $raw ) : '';
				break;
			case 'url':
				$value = esc_url_raw( $raw );
				break;
			case 'textarea':
				$value = sanitize_textarea_field( $raw );
				break;
			default:
				$value = sanitize_text_field( $raw );
		}

		if ( '' === $value ) {
			delete_post_meta( $post_id, $key );
		} else {
			update_post_meta( $post_id, $key, $value );
		}
	}
}
add_action( 'save_post_matro_product', 'matro_save_product_meta' );

/**
 * Product value helper with an optional fallback.
 */
function matro_product_meta( $post_id, $key, $fallback = '' ) {
	$value = get_post_meta( $post_id, '_matro_' . $key, true );
	return '' !== (string) $value ? $value : $fallback;
}

/**
 * Prefer a featured image, then the external placeholder URL.
 */
function matro_product_image_url( $post_id, $size = 'matro-product-card' ) {
	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, $size );
		if ( $image ) {
			return $image;
		}
	}

	return matro_product_meta( $post_id, 'image_url', get_template_directory_uri() . '/assets/images/product-placeholder.svg' );
}

/**
 * Add an English label to product categories and tags.
 */
function matro_taxonomy_english_field_add() {
	?>
	<div class="form-field">
		<label for="matro_name_en">Název anglicky</label>
		<input type="text" name="matro_name_en" id="matro_name_en" value="">
	</div>
	<?php
}

function matro_taxonomy_english_field_edit( $term ) {
	?>
	<tr class="form-field">
		<th scope="row"><label for="matro_name_en">Název anglicky</label></th>
		<td><input type="text" name="matro_name_en" id="matro_name_en" value="<?php echo esc_attr( get_term_meta( $term->term_id, 'matro_name_en', true ) ); ?>"></td>
	</tr>
	<?php
}

foreach ( array( 'matro_product_category', 'matro_product_tag' ) as $taxonomy ) {
	add_action( $taxonomy . '_add_form_fields', 'matro_taxonomy_english_field_add' );
	add_action( $taxonomy . '_edit_form_fields', 'matro_taxonomy_english_field_edit' );
}

/**
 * Save the taxonomy translation.
 */
function matro_save_taxonomy_english_field( $term_id ) {
	if ( isset( $_POST['matro_name_en'] ) && current_user_can( 'manage_categories' ) ) {
		update_term_meta( $term_id, 'matro_name_en', sanitize_text_field( wp_unslash( $_POST['matro_name_en'] ) ) );
	}
}
add_action( 'created_matro_product_category', 'matro_save_taxonomy_english_field' );
add_action( 'edited_matro_product_category', 'matro_save_taxonomy_english_field' );
add_action( 'created_matro_product_tag', 'matro_save_taxonomy_english_field' );
add_action( 'edited_matro_product_tag', 'matro_save_taxonomy_english_field' );

