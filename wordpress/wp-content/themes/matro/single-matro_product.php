<?php
/**
 * Product detail.
 *
 * @package Matro
 */

get_header();
the_post();

$product_id     = get_the_ID();
$name_cs        = get_the_title();
$name_en        = matro_product_meta( $product_id, 'name_en', $name_cs );
$description_cs = matro_product_meta( $product_id, 'description_cs' );
$description_en = matro_product_meta( $product_id, 'description_en', $description_cs );
$price          = (float) matro_product_meta( $product_id, 'price_ex_vat', 0 );
$vat            = (float) matro_product_meta( $product_id, 'vat_rate', 12 );
$price_vat      = $price * ( 1 + $vat / 100 );
$brand          = matro_product_meta( $product_id, 'brand' );
$sku            = matro_product_meta( $product_id, 'sku' );
$package_cs     = matro_product_meta( $product_id, 'package_cs' );
$package_en     = matro_product_meta( $product_id, 'package_en', $package_cs );
$minimum        = (int) matro_product_meta( $product_id, 'min_order', 1 );
$categories     = get_the_terms( $product_id, 'matro_product_category' );
$tags           = get_the_terms( $product_id, 'matro_product_tag' );
$category_names = $categories && ! is_wp_error( $categories ) ? matro_term_names( $categories[0] ) : array( 'cs' => '', 'en' => '' );
?>
<main id="main-content" class="site-main product-detail">
	<div class="container">
		<a class="back-link" href="<?php echo esc_url( get_post_type_archive_link( 'matro_product' ) ); ?>"><span aria-hidden="true">←</span><?php matro_bilingual( 'back_to_catalog' ); ?></a>
		<section class="product-hero">
			<div class="product-hero__image"><img src="<?php echo esc_url( matro_product_image_url( $product_id, 'matro-product-detail' ) ); ?>" alt="<?php echo esc_attr( $name_cs ); ?>"></div>
			<div class="product-hero__content">
				<div class="product-hero__badges">
					<?php if ( $category_names['cs'] ) : ?><span class="badge badge--green"><?php matro_pair( $category_names['cs'], $category_names['en'] ); ?></span><?php endif; ?>
					<?php if ( $brand ) : ?><span class="badge"><?php echo esc_html( $brand ); ?></span><?php endif; ?>
				</div>
				<?php matro_pair( $name_cs, $name_en, 'h1' ); ?>
				<?php matro_pair( $description_cs, $description_en, 'p', 'product-hero__description' ); ?>
				<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
					<div class="product-tags">
						<?php foreach ( $tags as $tag ) : $tag_names = matro_term_names( $tag ); ?><span><?php matro_pair( $tag_names['cs'], $tag_names['en'] ); ?></span><?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="product-hero__prices price-grid">
					<div><small><?php matro_bilingual( 'excluding_vat' ); ?></small><strong><span data-lang="cs"><?php echo esc_html( matro_format_price( $price, 'cs' ) ); ?></span><span data-lang="en"><?php echo esc_html( matro_format_price( $price, 'en' ) ); ?></span></strong><em><?php matro_bilingual( 'per_piece' ); ?></em></div>
					<div><small><?php matro_bilingual( 'including_vat' ); ?></small><strong><span data-lang="cs"><?php echo esc_html( matro_format_price( $price_vat, 'cs' ) ); ?></span><span data-lang="en"><?php echo esc_html( matro_format_price( $price_vat, 'en' ) ); ?></span></strong><em><?php matro_bilingual( 'vat' ); ?> <?php echo esc_html( $vat ); ?> %</em></div>
				</div>
			</div>
		</section>

		<section class="product-information">
			<div class="b2b-card">
				<?php matro_bilingual( 'b2b_info', 'p', 'eyebrow' ); ?>
				<dl>
					<div><dt><?php matro_bilingual( 'catalog_number' ); ?></dt><dd><?php echo esc_html( $sku ); ?></dd></div>
					<div><dt><?php matro_bilingual( 'brand' ); ?></dt><dd><?php echo esc_html( $brand ); ?></dd></div>
					<div><dt><?php matro_bilingual( 'package' ); ?></dt><dd><?php matro_pair( $package_cs, $package_en ); ?></dd></div>
					<div><dt><?php matro_bilingual( 'min_order' ); ?></dt><dd><?php echo esc_html( $minimum ); ?> <?php matro_bilingual( 'pieces' ); ?></dd></div>
				</dl>
			</div>
			<div class="documentation-card">
				<?php
				$documents = array(
					'composition' => array( matro_product_meta( $product_id, 'composition_cs' ), matro_product_meta( $product_id, 'composition_en' ) ),
					'allergens'   => array( matro_product_meta( $product_id, 'allergens_cs' ), matro_product_meta( $product_id, 'allergens_en' ) ),
					'nutrition'   => array( matro_product_meta( $product_id, 'nutrition_cs' ), matro_product_meta( $product_id, 'nutrition_en' ) ),
				);
				foreach ( $documents as $key => $values ) :
					$fallback_cs = matro_string( 'product_documentation', 'cs' );
					$fallback_en = matro_string( 'product_documentation', 'en' );
					?>
					<div><?php matro_bilingual( $key, 'h2' ); ?><?php matro_pair( $values[0] ? $values[0] : $fallback_cs, $values[1] ? $values[1] : $fallback_en, 'p' ); ?></div>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="product-cta">
			<div><?php matro_bilingual( 'contact_product_title', 'h2' ); ?><?php matro_bilingual( 'contact_product_text', 'p' ); ?></div>
			<a class="button button--dark" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php matro_bilingual( 'contact_matro' ); ?><span aria-hidden="true">→</span></a>
		</section>
	</div>
</main>
<?php get_footer(); ?>

