<?php
/**
 * News archive (category / tag / date archives of the standard blog posts).
 */
get_header();
?>

<main>
	<section class="section section--bg-base" aria-labelledby="archive-heading">
		<div class="container-mid">
			<?php browme_section_heading( 'News', wp_strip_all_tags( get_the_archive_title() ), array( 'id' => 'archive-heading' ) ); ?>

			<div class="card news-list">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php browme_news_item( get_post() ); ?>
					<?php endwhile; ?>
				<?php else : ?>
					<p style="padding: 20px;">お知らせはまだありません。</p>
				<?php endif; ?>
			</div>

			<div class="pagination-nav">
				<?php echo get_previous_posts_link( '← 新しい記事' ); ?>
				<?php echo get_next_posts_link( '古い記事 →' ); ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
