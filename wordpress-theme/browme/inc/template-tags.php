<?php
/**
 * Reusable markup helpers — keeps front-page.php / page-recruit.php readable
 * and guarantees the section-heading / card markup stays identical wherever
 * it's used, matching the original design reference 1:1.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL of the page currently assigned a given page template (e.g.
 * "page-recruit.php"), looked up dynamically so the theme keeps working
 * whatever slug the client renames the page to. Falls back to the site
 * home if no page uses that template yet.
 */
function browme_template_page_url( $template_file ) {
	static $cache = array();
	if ( isset( $cache[ $template_file ] ) ) {
		return $cache[ $template_file ];
	}

	$pages = get_posts( array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'meta_key'       => '_wp_page_template',
		'meta_value'     => $template_file,
		'no_found_rows'  => true,
	) );

	$url = $pages ? get_permalink( $pages[0] ) : home_url( '/' );
	$cache[ $template_file ] = $url;
	return $url;
}

/**
 * Section heading: centered EN/JP labels flanked by rules.
 */
function browme_section_heading( $en, $jp, $args = array() ) {
	$args = wp_parse_args( $args, array(
		'on_dark' => false,
		'id'      => '',
	) );

	$classes = array( 'section-heading' );
	if ( $args['on_dark'] ) {
		$classes[] = 'section-heading--on-dark';
	}
	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<span class="section-heading__rule"></span>
		<div class="section-heading__labels">
			<p class="section-heading__en"<?php echo $args['id'] ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>><?php echo esc_html( $en ); ?></p>
			<p class="section-heading__jp"><?php echo wp_kses_post( $jp ); ?></p>
		</div>
		<span class="section-heading__rule"></span>
	</div>
	<?php
}

/**
 * One store card — used in the Locations section of the front page.
 */
function browme_store_card( $post_id ) {
	$name    = get_the_title( $post_id );
	$badge   = get_field( 'store_badge', $post_id ) ?: 'EYEBROW SALON';
	$address = get_field( 'store_address', $post_id );
	$access  = get_field( 'store_access', $post_id );
	$hours   = get_field( 'store_hours', $post_id );
	$holiday = get_field( 'store_holiday', $post_id ) ?: '年末年始（12/30〜1/3）';
	$payment = get_field( 'store_payment', $post_id );
	$booking = get_field( 'store_hotpepper_url', $post_id );
	$map     = get_field( 'store_map_url', $post_id );

	if ( has_post_thumbnail( $post_id ) ) {
		$img = get_the_post_thumbnail( $post_id, 'browme-card', array( 'alt' => $name . 'の店舗写真' ) );
	} else {
		$img = '<img src="' . esc_url( BROWME_URI . '/img/salon01.jpeg' ) . '" alt="" loading="lazy" decoding="async">';
	}
	?>
	<article class="store-card">
		<div class="store-card__media">
			<div class="img-wrapper"><?php echo $img; ?></div>
		</div>
		<div class="store-card__body">
			<div class="store-card__head">
				<h3 class="store-card__name"><?php echo esc_html( $name ); ?></h3>
				<span class="store-card__badge"><?php echo esc_html( $badge ); ?></span>
			</div>
			<div class="store-card__facts">
				<?php if ( $address ) : ?>
				<div class="store-card__fact"><span class="store-card__fact-label">住所</span><span><?php echo esc_html( $address ); ?></span></div>
				<?php endif; ?>
				<?php if ( $access ) : ?>
				<div class="store-card__fact"><span class="store-card__fact-label">アクセス</span><span><?php echo esc_html( $access ); ?></span></div>
				<?php endif; ?>
				<?php if ( $hours ) : ?>
				<div class="store-card__fact"><span class="store-card__fact-label">営業時間</span><span><?php echo esc_html( $hours ); ?></span></div>
				<?php endif; ?>
				<?php if ( $holiday ) : ?>
				<div class="store-card__fact"><span class="store-card__fact-label">定休日</span><span><?php echo esc_html( $holiday ); ?></span></div>
				<?php endif; ?>
				<?php if ( $payment ) : ?>
				<div class="store-card__fact"><span class="store-card__fact-label">お支払い</span><span><?php echo esc_html( $payment ); ?></span></div>
				<?php endif; ?>
			</div>
			<div class="store-card__actions">
				<?php if ( $booking ) : ?>
					<a href="<?php echo esc_url( $booking ); ?>" target="_blank" rel="noopener" class="btn btn-primary">WEB予約</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-primary">お問い合わせ</a>
				<?php endif; ?>
				<?php if ( $map ) : ?>
					<a href="<?php echo esc_url( $map ); ?>" target="_blank" rel="noopener" class="btn btn-secondary">地図を見る</a>
				<?php endif; ?>
			</div>
		</div>
	</article>
	<?php
}

/**
 * One voice card — clicking opens the shared modal (js/main.js reads the
 * data-* attributes below), and mirrors them into visible child elements
 * so the card itself still reads fine when JS is unavailable.
 */
function browme_voice_card( $post_id, $index = 0 ) {
	$name    = get_the_title( $post_id );
	$role    = get_field( 'voice_role', $post_id );
	$title   = get_field( 'voice_quote_title', $post_id );
	$body    = get_field( 'voice_body', $post_id );
	$excerpt = wp_html_excerpt( wp_strip_all_tags( $body ), 60, '…' );

	$default_avatars = array( 'voice-y.svg', 'voice-t.svg', 'voice-k.svg' );
	if ( has_post_thumbnail( $post_id ) ) {
		$avatar_src = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
	} else {
		$avatar_src = BROWME_URI . '/img/' . $default_avatars[ $index % 3 ];
	}
	?>
	<div class="voice-card" data-voice-card
		role="button" tabindex="0"
		data-avatar-src="<?php echo esc_url( $avatar_src ); ?>"
		data-avatar-alt="<?php echo esc_attr( $name . 'のイラスト' ); ?>"
		data-name="<?php echo esc_attr( $name ); ?>"
		data-role="<?php echo esc_attr( $role ); ?>"
		data-title="<?php echo esc_attr( $title ); ?>"
		data-body="<?php echo esc_attr( $body ); ?>">
		<div class="voice-card__avatar"><img src="<?php echo esc_url( $avatar_src ); ?>" alt="<?php echo esc_attr( $name . 'のイラスト' ); ?>" width="84" height="84" loading="lazy" decoding="async"></div>
		<p class="voice-card__name"><?php echo esc_html( $name ); ?></p>
		<p class="voice-card__role"><?php echo esc_html( $role ); ?></p>
		<p class="voice-card__title"><?php echo esc_html( $title ); ?></p>
		<p class="voice-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
		<span class="voice-card__more">続きを読む +</span>
	</div>
	<?php
}

/**
 * The shared modal markup that voice cards expand into (js/main.js fills
 * it in from the clicked card's data-* attributes). Print once per page.
 */
function browme_voice_modal() {
	?>
	<div class="voice-modal-overlay" data-voice-modal hidden>
		<div class="voice-modal" data-voice-modal-dialog role="dialog" aria-modal="true" aria-labelledby="voice-modal-name">
			<button type="button" class="voice-modal__close" data-voice-modal-close aria-label="閉じる">×</button>
			<div class="voice-modal__head">
				<div class="voice-modal__avatar"><img data-voice-modal-avatar src="data:," alt=""></div>
				<p class="voice-modal__name" id="voice-modal-name" data-voice-modal-name></p>
				<p class="voice-modal__role" data-voice-modal-role></p>
			</div>
			<p class="voice-modal__title" data-voice-modal-title></p>
			<p class="voice-modal__body" data-voice-modal-body></p>
		</div>
	</div>
	<?php
}

/**
 * One news row — used by the News section on the front page. Accent tag
 * styling is applied to every category except "メンズ", matching the
 * original design reference (campaign/notice accented, mens plain).
 */
function browme_news_item( $post ) {
	$categories = get_the_category( $post->ID );
	$cat_name   = $categories ? $categories[0]->name : 'お知らせ';
	$is_accent  = ! ( $categories && 'mens' === $categories[0]->slug );
	?>
	<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="news-item">
		<span class="news-item__date"><?php echo esc_html( get_the_date( 'Y.m.d', $post ) ); ?></span>
		<span class="news-item__tag<?php echo $is_accent ? ' news-item__tag--accent' : ''; ?>"><?php echo esc_html( $cat_name ); ?></span>
		<span class="news-item__title"><?php echo esc_html( get_the_title( $post ) ); ?></span>
	</a>
	<?php
}
