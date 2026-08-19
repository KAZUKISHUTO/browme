<?php
/**
 * Generic page template — used for any WP Page that isn't assigned the
 * Recruit or Privacy Policy template (e.g. pages the client adds later).
 */
get_header();
?>

<main>
	<section class="section section--bg-base">
		<div class="container-mid">
			<?php while ( have_posts() ) : the_post(); ?>
				<h1 style="font-family: var(--font-heading-jp); font-size: clamp(22px, 4vw, 28px); text-align: center; margin: 0 0 32px;"><?php the_title(); ?></h1>
				<div class="legal-content">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
