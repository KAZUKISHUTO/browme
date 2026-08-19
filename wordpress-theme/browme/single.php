<?php
/**
 * Single news article — same section chrome as the rest of the site,
 * linked from the front page's News list.
 */
get_header();
?>

<main>
	<section class="section section--bg-base" aria-labelledby="article-heading">
		<div class="container-mid">
			<?php browme_section_heading( 'News', 'お知らせ', array( 'id' => 'article-heading' ) ); ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?>>
					<h1 style="font-family: var(--font-heading-jp); font-size: clamp(20px, 4vw, 26px); text-align: center; margin: 0 0 12px;"><?php the_title(); ?></h1>
					<p class="article-meta">
						<?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
						<?php
						$cats = get_the_category();
						if ( $cats ) {
							echo ' ／ ' . esc_html( $cats[0]->name );
						}
						?>
					</p>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="img-wrapper" style="margin-bottom: 32px;">
							<?php the_post_thumbnail( 'browme-card' ); ?>
						</div>
					<?php endif; ?>

					<div class="article-body">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>

			<div class="pagination-nav">
				<a href="<?php echo esc_url( home_url( '/#news' ) ); ?>">← お知らせ一覧へ戻る</a>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
