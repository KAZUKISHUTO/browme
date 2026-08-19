<?php
get_header();
?>

<main>
	<section class="section section--bg-base section--cta-bottom">
		<div class="container-narrow" style="text-align: center;">
			<?php browme_section_heading( '404', 'ページが見つかりません' ); ?>
			<p style="margin-bottom: 32px;">お探しのページは移動または削除された可能性があります。</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-dark btn-lg">トップページへ戻る</a>
		</div>
	</section>
</main>

<?php get_footer(); ?>
