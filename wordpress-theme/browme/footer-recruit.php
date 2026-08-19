	<footer class="site-footer" style="background: var(--color-footer-recruit);">
		<div class="container" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
			<div class="site-footer__logo">
				<span class="site-footer__logo-mark" style="font-size: 20px;">browme</span>
				<span class="site-footer__logo-sub">RECRUIT</span>
			</div>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="font-size: 12px; letter-spacing: 0.08em; color: rgba(255,255,255,0.7);">← コーポレートサイトへ戻る</a>
			<a href="<?php echo esc_url( browme_template_page_url( 'page-privacy.php' ) ); ?>" style="font-size: 12px; letter-spacing: 0.08em; color: rgba(255,255,255,0.7);">プライバシーポリシー</a>
			<p class="site-footer__copyright">© <?php echo esc_html( date_i18n( 'Y' ) ); ?> Duo Inc. All Rights Reserved.</p>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
