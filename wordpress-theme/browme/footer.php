	<footer class="site-footer" style="background: var(--color-footer-top)">
		<div class="container">
			<div class="site-footer__logo">
				<span class="site-footer__logo-mark">browme</span>
			</div>
			<ul class="site-footer__nav">
				<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">About Us</a></li>
				<li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>">Services</a></li>
				<li><a href="<?php echo esc_url( home_url( '/#locations' ) ); ?>">Locations</a></li>
				<li><a href="<?php echo esc_url( home_url( '/#news' ) ); ?>">News</a></li>
				<li><a href="<?php echo esc_url( browme_template_page_url( 'page-recruit.php' ) ); ?>">Recruit</a></li>
				<li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a></li>
				<li><a href="<?php echo esc_url( browme_template_page_url( 'page-privacy.php' ) ); ?>">プライバシーポリシー</a></li>
			</ul>
			<p class="site-footer__copyright">© <?php echo esc_html( date_i18n( 'Y' ) ); ?> Duo Inc. All Rights Reserved.</p>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
