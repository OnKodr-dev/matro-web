<?php
/**
 * Generic fallback template.
 *
 * @package Matro
 */

get_header();
?>
<main id="main-content" class="site-main">
	<div class="container generic-content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?>><h1><?php the_title(); ?></h1><div class="entry-content"><?php the_content(); ?></div></article>
			<?php endwhile; ?>
		<?php else : ?>
			<h1><?php matro_bilingual( 'not_found_title' ); ?></h1>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>

