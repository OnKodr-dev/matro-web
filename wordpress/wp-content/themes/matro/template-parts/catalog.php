<?php
/**
 * Shared interactive catalogue.
 *
 * @package Matro
 */

$categories = get_terms(
	array(
		'taxonomy'   => 'matro_product_category',
		'hide_empty' => true,
		'orderby'    => 'name',
	)
);
$products = new WP_Query(
	array(
		'post_type'      => 'matro_product',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
	)
);
?>
<section class="catalog-section" id="katalog" data-catalog>
	<div class="container">
		<div class="section-heading">
			<?php matro_bilingual( 'assortment_eyebrow', 'p', 'eyebrow' ); ?>
			<?php matro_bilingual( 'assortment_title', 'h2' ); ?>
			<?php matro_bilingual( 'assortment_text', 'p', 'section-heading__lead' ); ?>
		</div>

		<div class="catalog-filters">
			<div class="catalog-filters__top">
				<label class="search-field">
					<span aria-hidden="true">⌕</span>
					<input type="search" data-catalog-search placeholder="<?php echo esc_attr( matro_string( 'search_placeholder', 'cs' ) ); ?>" data-placeholder-cs="<?php echo esc_attr( matro_string( 'search_placeholder', 'cs' ) ); ?>" data-placeholder-en="<?php echo esc_attr( matro_string( 'search_placeholder', 'en' ) ); ?>">
				</label>
				<label class="sort-field">
					<?php matro_bilingual( 'sorting', 'span' ); ?>
					<select data-catalog-sort>
						<option value="relevance" data-label-cs="<?php echo esc_attr( matro_string( 'relevance', 'cs' ) ); ?>" data-label-en="<?php echo esc_attr( matro_string( 'relevance', 'en' ) ); ?>"><?php echo esc_html( matro_string( 'relevance', 'cs' ) ); ?></option>
						<option value="name" data-label-cs="<?php echo esc_attr( matro_string( 'name_asc', 'cs' ) ); ?>" data-label-en="<?php echo esc_attr( matro_string( 'name_asc', 'en' ) ); ?>"><?php echo esc_html( matro_string( 'name_asc', 'cs' ) ); ?></option>
						<option value="price-asc" data-label-cs="<?php echo esc_attr( matro_string( 'price_asc', 'cs' ) ); ?>" data-label-en="<?php echo esc_attr( matro_string( 'price_asc', 'en' ) ); ?>"><?php echo esc_html( matro_string( 'price_asc', 'cs' ) ); ?></option>
						<option value="price-desc" data-label-cs="<?php echo esc_attr( matro_string( 'price_desc', 'cs' ) ); ?>" data-label-en="<?php echo esc_attr( matro_string( 'price_desc', 'en' ) ); ?>"><?php echo esc_html( matro_string( 'price_desc', 'cs' ) ); ?></option>
					</select>
				</label>
			</div>
			<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
				<div class="catalog-filters__categories">
					<div class="catalog-filters__label"><strong><?php matro_bilingual( 'categories' ); ?></strong><button type="button" data-clear-filters hidden><?php matro_bilingual( 'clear_filters' ); ?></button></div>
					<div class="category-buttons">
						<?php foreach ( $categories as $category ) : ?>
							<?php $names = matro_term_names( $category ); ?>
							<button type="button" data-category-filter="<?php echo esc_attr( $category->slug ); ?>" aria-pressed="false"><?php matro_pair( $names['cs'], $names['en'] ); ?></button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="product-grid" data-product-grid>
			<?php if ( $products->have_posts() ) : ?>
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<?php get_template_part( 'template-parts/product-card', null, array( 'product_id' => get_the_ID() ) ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
		<div class="catalog-empty" data-catalog-empty hidden><?php matro_bilingual( 'no_products' ); ?></div>

		<section class="catalog-cta">
			<div>
				<p class="eyebrow">MATRO B2B</p>
				<?php matro_bilingual( 'catalog_cta_title', 'h2' ); ?>
				<?php matro_bilingual( 'catalog_cta_text', 'p' ); ?>
			</div>
			<a class="button button--dark" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php matro_bilingual( 'contact_matro' ); ?><span aria-hidden="true">→</span></a>
		</section>
	</div>
</section>
<div class="product-modal" data-product-modal hidden>
	<div class="product-modal__overlay" data-modal-close></div>
	<div class="product-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="product-modal-title">
		<header><h2 id="product-modal-title" data-modal-title></h2><button type="button" data-modal-close data-aria-cs="Zavřít" data-aria-en="Close" aria-label="Zavřít">×</button></header>
		<div class="product-modal__content" data-modal-content></div>
	</div>
</div>
