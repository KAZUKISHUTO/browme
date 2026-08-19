<?php
/**
 * Custom post types: Store（店舗）/ Voice（スタッフの声）
 * News is intentionally left as core Posts.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function browme_register_post_types() {
	register_post_type( 'store', array(
		'labels' => array(
			'name'               => '店舗',
			'singular_name'      => '店舗',
			'add_new_item'       => '新規店舗を追加',
			'edit_item'          => '店舗を編集',
			'all_items'          => '店舗一覧',
			'menu_name'          => '店舗（Locations）',
			'featured_image'     => '店舗写真',
			'set_featured_image' => '店舗写真を設定',
		),
		'public'        => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-store',
		'menu_position' => 20,
		'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
		'has_archive'   => false,
		'rewrite'       => false,
	) );

	register_post_type( 'voice', array(
		'labels' => array(
			'name'               => 'スタッフの声',
			'singular_name'      => 'スタッフの声',
			'add_new_item'       => '新規スタッフの声を追加',
			'edit_item'          => 'スタッフの声を編集',
			'all_items'          => 'スタッフの声一覧',
			'menu_name'          => 'スタッフの声（Voices）',
			'featured_image'     => 'イラスト・写真',
			'set_featured_image' => 'イラスト・写真を設定',
		),
		'public'        => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-groups',
		'menu_position' => 21,
		'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
		'has_archive'   => false,
		'rewrite'       => false,
	) );
}
add_action( 'init', 'browme_register_post_types' );

/**
 * ACF field groups — shipped in code so the fields appear as soon as
 * the (free) Advanced Custom Fields plugin is active, no manual setup.
 */
function browme_acf_field_groups() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'    => 'group_browme_store',
		'title'  => '店舗情報',
		'fields' => array(
			array(
				'key'   => 'field_browme_store_badge',
				'label' => 'バッジ表記',
				'name'  => 'store_badge',
				'type'  => 'text',
				'default_value' => 'EYEBROW SALON',
			),
			array(
				'key'   => 'field_browme_store_address',
				'label' => '住所（〒含む）',
				'name'  => 'store_address',
				'type'  => 'text',
				'required' => 1,
			),
			array(
				'key'   => 'field_browme_store_access',
				'label' => 'アクセス',
				'name'  => 'store_access',
				'type'  => 'text',
				'required' => 1,
			),
			array(
				'key'   => 'field_browme_store_hours',
				'label' => '営業時間',
				'name'  => 'store_hours',
				'type'  => 'text',
				'placeholder' => '10:00 - 20:00',
				'required' => 1,
			),
			array(
				'key'   => 'field_browme_store_holiday',
				'label' => '定休日',
				'name'  => 'store_holiday',
				'type'  => 'text',
				'default_value' => '年末年始（12/30〜1/3）',
			),
			array(
				'key'   => 'field_browme_store_payment',
				'label' => 'お支払い方法',
				'name'  => 'store_payment',
				'type'  => 'text',
				'default_value' => '各種クレジットカード／現金／電子マネー／QRコード決済',
			),
			array(
				'key'   => 'field_browme_store_hotpepper_url',
				'label' => 'WEB予約URL（ホットペッパー等）',
				'name'  => 'store_hotpepper_url',
				'type'  => 'url',
			),
			array(
				'key'   => 'field_browme_store_map_url',
				'label' => '地図URL（Googleマップ）',
				'name'  => 'store_map_url',
				'type'  => 'url',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'store',
				),
			),
		),
	) );

	acf_add_local_field_group( array(
		'key'    => 'group_browme_voice',
		'title'  => 'スタッフの声',
		'fields' => array(
			array(
				'key'   => 'field_browme_voice_role',
				'label' => '役職・経歴',
				'name'  => 'voice_role',
				'type'  => 'text',
				'placeholder' => 'アイブロウリスト（社員）／未経験入社・歴4ヶ月',
				'required' => 1,
			),
			array(
				'key'   => 'field_browme_voice_quote_title',
				'label' => '見出し（カギカッコ付きの一言）',
				'name'  => 'voice_quote_title',
				'type'  => 'text',
				'placeholder' => '「未経験だから、browmeを選びました。」',
				'required' => 1,
			),
			array(
				'key'   => 'field_browme_voice_body',
				'label' => '本文（モーダルで全文表示）',
				'name'  => 'voice_body',
				'type'  => 'textarea',
				'rows'  => 8,
				'required' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'voice',
				),
			),
		),
	) );
}
add_action( 'acf/init', 'browme_acf_field_groups' );

/**
 * Notice if ACF isn't active — Store / Voice content editing depends on it.
 */
function browme_admin_notice_missing_acf() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	echo '<div class="notice notice-warning"><p>browme テーマ: 「Advanced Custom Fields」プラグインが有効化されていません。店舗情報・スタッフの声の詳細項目を編集するにはインストール・有効化してください。</p></div>';
}
add_action( 'admin_notices', 'browme_admin_notice_missing_acf' );
