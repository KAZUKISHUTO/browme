<?php
/**
 * Fallback template (required by WordPress). front-page.php, page-*.php,
 * single.php and archive.php cover every URL this theme actually needs;
 * this only renders if none of those match.
 */
get_header();
?>

<main>
	<section class="section section--bg-base">
		<div class="container-mid">
			<div class="card news-list">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php browme_news_item( get_post() ); ?>
					<?php endwhile; ?>
				<?php else : ?>
					<p style="padding: 20px;">コンテンツが見つかりませんでした。</p>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
