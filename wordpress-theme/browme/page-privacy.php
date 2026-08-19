<?php
/**
 * Template Name: プライバシーポリシー
 */
get_header( 'privacy' );
?>

<main>

	<section class="section section--bg-base" aria-labelledby="privacy-heading">
		<div class="container-mid">
			<?php browme_section_heading( 'Privacy Policy', 'プライバシーポリシー', array( 'id' => 'privacy-heading' ) ); ?>

			<div class="legal-content">
				<?php the_content(); ?>
			</div>

			<div class="legal-block">
				<h2>お問い合わせ窓口</h2>
				<p>個人情報の取り扱いに関するお問い合わせは、下記までご連絡ください。</p>
				<div class="company-table legal-contact">
					<div class="company-table__row"><span class="company-table__label">会社名</span><span>browme</span></div>
					<div class="company-table__row"><span class="company-table__label">住所</span><span>〒330-0854 埼玉県さいたま市大宮区桜木町2丁目158-5 リュウジンマンション1F</span></div>
					<div class="company-table__row"><span class="company-table__label">電話番号</span><span>070-1657-8984</span></div>
					<div class="company-table__row"><span class="company-table__label">連絡先</span><span><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">お問い合わせフォームはこちら</a></span></div>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
