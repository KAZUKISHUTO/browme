<?php
/**
 * Front page — one-page corporate site (Hero / About / Services / Locations / News / Recruit teaser / Contact).
 */
get_header();
?>

<main id="top">
	<!-- Hero -->
	<section class="hero" aria-label="Hero">
		<div class="hero__media">
			<div class="img-wrapper">
				<img src="<?php echo esc_url( BROWME_URI . '/img/top_kv.jpg' ); ?>" alt="店舗の内観" width="1920" height="1440">
			</div>
		</div>
		<div class="hero__overlay"></div>
		<div class="hero__content">
			<p class="hero__label">EYEBROW SALON browme</p>
			<h1 class="hero__title">深呼吸したくなる場所で、<br>似合う眉に出会う。</h1>
			<p class="hero__lead">ゆったりと落ち着いた空間で、丁寧なカウンセリングから。眉毛専門サロン「browme」が、骨格・表情に似合う自然な眉をデザインします。男性のご来店も歓迎です。</p>
		</div>
	</section>

	<!-- About -->
	<section id="about" class="section section--bg-base" aria-labelledby="about-heading">
		<div class="container">
			<?php browme_section_heading( 'About Us', '企業情報', array( 'id' => 'about-heading' ) ); ?>
			<div class="about-grid">
				<div class="about-copy">
					<h2>「Duo」— お客様とサロンの、<br>ふたりで奏でる美しさ。</h2>
					<p>社名の「Duo」には、お客様とスタッフ、技術と心づかい、日常と特別感——ふたつの要素が響き合ってはじめて生まれる調和への想いを込めています。</p>
					<p>私たちは、確かな技術と上質な空間を、誰もが通い続けられるかたちでお届けすることを使命としています。</p>
				</div>
				<div class="about-media">
					<div class="about-photo" style="margin-bottom: 16px">
						<div class="img-wrapper">
							<img src="<?php echo esc_url( BROWME_URI . '/img/salon01.jpeg' ); ?>" alt="browmeサロンの内観" width="480" height="360" loading="lazy" decoding="async">
						</div>
					</div>
					<div class="card message-card">
						<p class="message-card__eyebrow">MESSAGE</p>
						<p class="message-card__body">「また来たい」と思っていただける時間をつくること。それが私たちの原点です。丁寧なカウンセリングを通じて、一人ひとりの骨格や表情に似合う眉をご提案し、確かな技術でかたちにします。関わるすべての方の物語に、そっと寄り添えるサロンであり続けます。</p>
					</div>
				</div>
				<div class="company-table">
					<div class="company-table__row"><span class="company-table__label">会社名</span><span>browme</span></div>
					<div class="company-table__row"><span class="company-table__label">住所</span><span>〒330-0854 埼玉県さいたま市大宮区桜木町2丁目158-5 リュウジンマンション1F</span></div>
					<div class="company-table__row"><span class="company-table__label">電話番号</span><span>070-1657-8984</span></div>
					<div class="company-table__row"><span class="company-table__label">事業内容</span><span>アイブロウ・ビューティーサロンの経営・運営</span></div>
				</div>
			</div>
		</div>
	</section>

	<!-- Services -->
	<section id="services" class="section section--bg-card" aria-labelledby="services-heading">
		<div class="container">
			<?php browme_section_heading( 'Services', '事業・サービス内容', array( 'id' => 'services-heading' ) ); ?>
			<div class="card-grid">
				<article class="card service-card">
					<div class="service-card__media">
						<div class="img-wrapper">
							<img src="<?php echo esc_url( BROWME_URI . '/img/eyebrow01.JPG' ); ?>" alt="似合わせアイブロウWaxの施術Before/After" width="2560" height="2560" loading="lazy" decoding="async">
						</div>
					</div>
					<div class="service-card__body">
						<h3 class="service-card__title">似合わせアイブロウWax</h3>
						<p class="service-card__desc">骨格・表情に合わせて眉をデザインし、ワックスで丁寧に整えます。カウンセリング込みで、初めての方も安心の一番人気メニューです。</p>
						<p class="service-card__price">¥3,700 <span class="service-card__price-note">/ クーポン価格・税込</span></p>
					</div>
				</article>
				<article class="card service-card">
					<div class="service-card__media">
						<div class="img-wrapper">
							<img src="<?php echo esc_url( BROWME_URI . '/img/eyebrow02.JPG' ); ?>" alt="似合わせアイブロウWax＋間引きの施術Before/After" width="2560" height="2560" loading="lazy" decoding="async">
						</div>
					</div>
					<div class="service-card__body">
						<h3 class="service-card__title">似合わせアイブロウWax＋間引き</h3>
						<p class="service-card__desc">Waxデザインに加え、毛量の多い方向けの間引きをプラス。より軽やかで洗練された眉に仕上げます。</p>
						<p class="service-card__price">¥4,700 <span class="service-card__price-note">/ クーポン価格・税込</span></p>
					</div>
				</article>
				<article class="card service-card">
					<div class="service-card__media">
						<div class="img-wrapper">
							<img src="<?php echo esc_url( BROWME_URI . '/img/eyebrow03.JPG' ); ?>" alt="メンズアイブロウWaxの施術Before/After" width="2560" height="2560" loading="lazy" decoding="async">
						</div>
					</div>
					<div class="service-card__body">
						<h3 class="service-card__title">メンズアイブロウWax</h3>
						<p class="service-card__desc">男性の骨格・印象に合わせた眉デザイン。清潔感のある自然な仕上がりで、はじめての方にもおすすめです。</p>
						<p class="service-card__price">¥5,000 <span class="service-card__price-note">/ 税込</span></p>
					</div>
				</article>
			</div>
		</div>
	</section>

	<!-- Locations -->
	<section id="locations" class="section section--bg-dark" aria-labelledby="locations-heading">
		<div class="container">
			<?php browme_section_heading( 'Locations', '店舗情報・ご予約', array( 'on_dark' => true, 'id' => 'locations-heading' ) ); ?>
			<p class="locations-intro">女性・男性を問わず通える眉毛専門サロンを<?php
				$store_count = wp_count_posts( 'store' )->publish;
				echo esc_html( $store_count ? $store_count : 5 );
			?>店舗展開しています。各店舗のボタンからWEB予約いただけます。</p>
			<div class="store-grid">
				<?php
				$stores = new WP_Query( array(
					'post_type'      => 'store',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'no_found_rows'  => true,
				) );
				if ( $stores->have_posts() ) :
					while ( $stores->have_posts() ) : $stores->the_post();
						browme_store_card( get_the_ID() );
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p style="color: rgba(255,255,255,0.8);">店舗情報を準備中です。管理画面の「店舗（Locations）」から追加してください。</p>
					<?php
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- News -->
	<section id="news" class="section section--bg-base" aria-labelledby="news-heading">
		<div class="container">
			<?php browme_section_heading( 'News', 'お知らせ', array( 'id' => 'news-heading' ) ); ?>
			<div class="card news-list">
				<?php
				$news = new WP_Query( array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'no_found_rows'  => true,
				) );
				if ( $news->have_posts() ) :
					while ( $news->have_posts() ) : $news->the_post();
						browme_news_item( get_post() );
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p style="padding: 20px;">お知らせを準備中です。管理画面の「投稿」から追加してください。</p>
					<?php
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- Recruit teaser -->
	<section id="recruit" class="section section--bg-card" aria-labelledby="recruit-heading">
		<div class="container">
			<?php browme_section_heading( 'Recruit', '採用情報', array( 'id' => 'recruit-heading' ) ); ?>
			<div class="recruit-teaser">
				<div class="recruit-teaser__media">
					<div class="img-wrapper">
						<img src="<?php echo esc_url( BROWME_URI . '/img/work_staff.jpg' ); ?>" alt="" width="1920" height="1440" loading="lazy" decoding="async">
					</div>
					<div class="recruit-teaser__media-overlay">
						<p class="recruit-teaser__media-caption">好きを仕事に、<br>自分らしく働く。</p>
					</div>
				</div>
				<div class="recruit-teaser__copy">
					<h3 class="recruit-teaser__title">一人ひとりに向き合う時間を、<br>大切にできる職場です。</h3>
					<p class="recruit-teaser__lead">browmeで働くスタッフは、未経験からのスタートも、ブランクからの復帰もさまざま。お客様の「うれしい」に立ち会い、仲間と支え合いながら、自分のペースで成長していける環境です。</p>
					<div class="numbered-list" style="margin-bottom: 32px">
						<div class="numbered-row">
							<span class="numbered-row__num">01</span>
							<div>
								<p class="numbered-row__title">未経験から、プロへ。</p>
								<p class="numbered-row__body">入社後3ヶ月の技術研修と先輩の伴走で、デビューまで丁寧にサポート。</p>
							</div>
						</div>
						<div class="numbered-row">
							<span class="numbered-row__num">02</span>
							<div>
								<p class="numbered-row__title">がんばりが、返ってくる。</p>
								<p class="numbered-row__body">指名手当・歩合制度と透明な評価で、努力がきちんと収入とキャリアに。</p>
							</div>
						</div>
						<div class="numbered-row">
							<span class="numbered-row__num">03</span>
							<div>
								<p class="numbered-row__title">長く、心地よく働ける。</p>
								<p class="numbered-row__body">週休2日・社会保険完備。産休・育休からの復帰実績もあります。</p>
							</div>
						</div>
					</div>
					<div>
						<a href="<?php echo esc_url( browme_template_page_url( 'page-recruit.php' ) ); ?>" class="btn btn-dark btn-lg">採用情報を詳しく見る<span aria-hidden="true" style="font-family: &quot;Cormorant Garamond&quot;, serif">→</span></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact -->
	<section id="contact" class="section section--bg-base section--cta-bottom" aria-labelledby="contact-heading">
		<div class="container-narrow">
			<?php browme_section_heading( 'Contact', 'お問い合わせ', array( 'id' => 'contact-heading' ) ); ?>
			<?php browme_contact_form(); ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
