<?php
/**
 * One catalogue card and its quick-view template.
 *
 * @package Matro
 */

$product_id    = isset( $args['product_id'] ) ? absint( $args['product_id'] ) : get_the_ID();
$name_cs       = get_the_title( $product_id );
$name_en       = matro_product_meta( $product_id, 'name_en', $name_cs );
$description_cs= matro_product_meta( $product_id, 'description_cs' );
$description_en= matro_product_meta( $product_id, 'description_en', $description_cs );
$price         = (float) matro_product_meta( $product_id, 'price_ex_vat', 0 );
$vat           = (float) matro_product_meta( $product_id, 'vat_rate', 12 );
$price_vat     = $price * ( 1 + $vat / 100 );
$brand         = matro_product_meta( $product_id, 'brand' );
$package_cs    = matro_product_meta( $product_id, 'package_cs' );
$package_en    = matro_product_meta( $product_id, 'package_en', $package_cs );
$minimum       = (int) matro_product_meta( $product_id, 'min_order', 1 );
$image         = matro_product_image_url( $product_id );
$categories    = get_the_terms( $product_id, 'matro_product_category' );
$tags          = get_the_terms( $product_id, 'matro_product_tag' );
$category_slugs= array();
$category_cs   = '';
$category_en   = '';
if ( $categories && ! is_wp_error( $categories ) ) {
	$category_slugs = wp_list_pluck( $categories, 'slug' );
	$names          = matro_term_names( $categories[0] );
	$category_cs    = $names['cs'];
	$category_en    = $names['en'];
}
$searchable = implode( ' ', array( $name_cs, $name_en, $description_cs, $description_en, $brand, matro_product_meta( $product_id, 'sku' ), $category_cs, $category_en ) );
?>
<article class="product-card" data-product-card data-order="<?php echo esc_attr( $product_id ); ?>" data-name-cs="<?php echo esc_attr( $name_cs ); ?>" data-name-en="<?php echo esc_attr( $name_en ); ?>" data-price="<?php echo esc_attr( $price ); ?>" data-categories="<?php echo esc_attr( implode( ',', $category_slugs ) ); ?>" data-search="<?php echo esc_attr( $searchable ); ?>">
	<button class="product-card__image" type="button" data-modal-open="quick-product-<?php echo esc_attr( $product_id ); ?>" data-aria-cs="<?php echo esc_attr( matro_string( 'quick_view', 'cs' ) . ': ' . $name_cs ); ?>" data-aria-en="<?php echo esc_attr( matro_string( 'quick_view', 'en' ) . ': ' . $name_en ); ?>" aria-label="<?php echo esc_attr( matro_string( 'quick_view', 'cs' ) . ': ' . $name_cs ); ?>">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name_cs ); ?>" loading="lazy">
		<?php if ( $brand ) : ?><span class="product-card__brand"><?php echo esc_html( $brand ); ?></span><?php endif; ?>
		<span class="product-card__open" aria-hidden="true">↗</span>
	</button>
	<div class="product-card__body">
		<?php if ( $category_cs ) : ?><?php matro_pair( $category_cs, $category_en, 'p', 'product-card__category' ); ?><?php endif; ?>
		<?php matro_pair( $name_cs, $name_en, 'h3' ); ?>
		<div class="price-grid">
			<div><small><?php matro_bilingual( 'excluding_vat' ); ?></small><strong><span data-lang="cs"><?php echo esc_html( matro_format_price( $price, 'cs' ) ); ?></span><span data-lang="en"><?php echo esc_html( matro_format_price( $price, 'en' ) ); ?></span></strong></div>
			<div><small><?php matro_bilingual( 'including_vat' ); ?></small><strong><span data-lang="cs"><?php echo esc_html( matro_format_price( $price_vat, 'cs' ) ); ?></span><span data-lang="en"><?php echo esc_html( matro_format_price( $price_vat, 'en' ) ); ?></span></strong></div>
		</div>
		<div class="product-card__meta">
			<span><?php matro_bilingual( 'min_order' ); ?>: <strong><?php echo esc_html( $minimum ); ?> <?php matro_bilingual( 'pieces' ); ?></strong></span>
			<span><?php matro_bilingual( 'package' ); ?>: <strong><?php matro_pair( $package_cs, $package_en ); ?></strong></span>
		</div>
		<a class="product-card__link" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php matro_bilingual( 'detail' ); ?><span aria-hidden="true">→</span></a>
	</div>
</article>
<template id="quick-product-<?php echo esc_attr( $product_id ); ?>">
	<div class="quick-product" data-title-cs="<?php echo esc_attr( $name_cs ); ?>" data-title-en="<?php echo esc_attr( $name_en ); ?>">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name_cs ); ?>">
		<div>
			<?php if ( $category_cs ) : ?><?php matro_pair( $category_cs, $category_en, 'p', 'eyebrow' ); ?><?php endif; ?>
			<?php matro_pair( $description_cs, $description_en, 'p', 'quick-product__description' ); ?>
			<div class="quick-product__tags">
				<?php if ( $tags && ! is_wp_error( $tags ) ) : foreach ( $tags as $tag ) : $tag_names = matro_term_names( $tag ); ?>
					<span><?php matro_pair( $tag_names['cs'], $tag_names['en'] ); ?></span>
				<?php endforeach; endif; ?>
			</div>
			<div class="price-grid">
				<div><small><?php matro_bilingual( 'excluding_vat' ); ?></small><strong><span data-lang="cs"><?php echo esc_html( matro_format_price( $price, 'cs' ) ); ?></span><span data-lang="en"><?php echo esc_html( matro_format_price( $price, 'en' ) ); ?></span></strong></div>
				<div><small><?php matro_bilingual( 'including_vat' ); ?></small><strong><span data-lang="cs"><?php echo esc_html( matro_format_price( $price_vat, 'cs' ) ); ?></span><span data-lang="en"><?php echo esc_html( matro_format_price( $price_vat, 'en' ) ); ?></span></strong></div>
			</div>
			<a class="button button--dark" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php matro_bilingual( 'detail' ); ?><span aria-hidden="true">→</span></a>
		</div>
	</div>
</template>
