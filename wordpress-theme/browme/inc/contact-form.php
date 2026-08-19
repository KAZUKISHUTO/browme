<?php
/**
 * Contact Form 7 integration.
 *
 * The theme provisions its own CF7 form on first run (matching the
 * `.form-field` markup the design's CSS expects) so the Contact section
 * works immediately once the Contact Form 7 plugin is active — no manual
 * form-building required. Re-running is a no-op: it checks for the
 * previously created form before creating another.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BROWME_CF7_TITLE', 'browme お問い合わせフォーム' );

function browme_cf7_form_template() {
	return <<<FORM
<label class="form-field">お問い合わせ項目 <span class="form-field__required">必須</span>
[select* inquiry-type first_as_label "選択してください" "ご予約について|reservation" "施術・メニューについて|menu" "採用について|recruit" "取材・協業のご相談|business" "その他|other"]
</label>

<label class="form-field">お名前 <span class="form-field__required">必須</span>
[text* your-name placeholder "山田 花子"]
</label>

<label class="form-field">会社名（任意）
[text your-company]
</label>

<label class="form-field">メールアドレス <span class="form-field__required">必須</span>
[email* your-email placeholder "example@duo.co.jp"]
</label>

<label class="form-field">お問い合わせ内容 <span class="form-field__required">必須</span>
[textarea* your-message placeholder "ご予約に関するご質問、採用へのご応募など"]
</label>

[submit class:btn class:btn-primary class:btn-block "送信する"]
FORM;
}

/**
 * Create (or find) the browme contact form. Safe to call repeatedly.
 */
function browme_ensure_cf7_form() {
	if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
		return 0;
	}

	$stored_id = (int) get_option( 'browme_cf7_form_id' );
	if ( $stored_id && get_post( $stored_id ) && 'wpcf7_contact_form' === get_post_type( $stored_id ) ) {
		return $stored_id;
	}

	$existing = get_page_by_title( BROWME_CF7_TITLE, OBJECT, 'wpcf7_contact_form' );
	if ( $existing ) {
		update_option( 'browme_cf7_form_id', $existing->ID );
		return $existing->ID;
	}

	$contact_form = WPCF7_ContactForm::get_template( array( 'title' => BROWME_CF7_TITLE ) );
	$properties   = $contact_form->get_properties();

	$properties['form']    = browme_cf7_form_template();
	$properties['mail']['subject']            = '[browme] お問い合わせがありました：[inquiry-type]';
	$properties['mail']['sender']              = get_bloginfo( 'name' ) . ' <wordpress@' . wp_parse_url( home_url(), PHP_URL_HOST ) . '>';
	$properties['mail']['recipient']           = get_option( 'admin_email' );
	$properties['mail']['additional_headers']  = 'Reply-To: [your-name] <[your-email]>';
	$properties['mail']['body']                = "お問い合わせ項目: [inquiry-type]\nお名前: [your-name]\n会社名: [your-company]\nメールアドレス: [your-email]\n\nお問い合わせ内容:\n[your-message]\n\n--\nこのメールは " . home_url( '/' ) . " のお問い合わせフォームから送信されました。";
	$properties['messages']['mail_sent_ok']    = '送信しました。担当者よりご連絡いたします。';
	$properties['messages']['mail_sent_ng']    = '送信に失敗しました。時間をおいて再度お試しください。';
	$properties['messages']['validation_error'] = '入力内容にエラーがあります。ご確認の上、再度お試しください。';

	$contact_form->set_properties( $properties );
	$contact_form->save();

	update_option( 'browme_cf7_form_id', $contact_form->id() );
	return $contact_form->id();
}
add_action( 'after_switch_theme', 'browme_ensure_cf7_form' );

/**
 * Renders the Contact section's form: the provisioned CF7 form when
 * available, otherwise a graceful fallback (with an admin-only nudge).
 */
function browme_contact_form() {
	if ( ! function_exists( 'wpcf7' ) ) {
		if ( current_user_can( 'activate_plugins' ) ) {
			echo '<p style="text-align:center;">「Contact Form 7」プラグインを有効化すると、お問い合わせフォームが表示されます。</p>';
		}
		return;
	}

	$form_id = browme_ensure_cf7_form();
	if ( ! $form_id ) {
		return;
	}

	echo '<div class="contact-form">';
	echo do_shortcode( '[contact-form-7 id="' . (int) $form_id . '" title="' . esc_attr( BROWME_CF7_TITLE ) . '"]' );
	echo '</div>';
}
