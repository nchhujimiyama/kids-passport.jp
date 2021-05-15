<?php

/**
 * 高速化処理
 *
 * @TODO キャッシュ系プラグイン等への対応
 */

/**
 * initialize
 *
 * @return void
 */
function tcd_acceleration_wp() {
	global $dp_options;

	// feed・管理画面・ajaxは終了
	if ( is_feed() || is_admin() || wp_doing_ajax() )
		return;

	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// テーマオプション高速化チェック
	if ( ! $dp_options['use_lazyload'] )
		return;

	// DOMDocumentクラスが無ければ終了
	if ( ! class_exists( 'DOMDocument' ) )
		return;

	// WordPressデフォルトで有効化になっているのshutdownアクションのwp_ob_end_flush_allを削除
	$priority = has_action( 'shutdown', 'wp_ob_end_flush_all' );
	if ( false === $priority )
		return;

	remove_action( 'shutdown', 'wp_ob_end_flush_all', $priority );

	// アクション・フィルター
	add_action( 'template_redirect', 'tcd_acceleration_ob_start', 1 );
	add_action( 'shutdown', 'wp_ob_end_flush_all', 2 );
	add_filter( 'tcd_acceleration_html', 'tcd_acceleration_html_dom' );

	// LazyLoad
	add_action( 'wp_enqueue_scripts', 'tcd_acceleration_lazyload_scripts' );
	add_action( 'tcd_acceleration_html_dom', 'tcd_acceleration_dom_lazyload' );
	add_filter( 'tcd_acceleration_debug_massage', 'tcd_acceleration_lazyload_debug_massage' );
}
add_action( 'wp', 'tcd_acceleration_wp' );

/**
 * html操作するためのob_start用関数
 *
 * @return void
 */
function tcd_acceleration_ob_start() {
	global $tcd_acceleration_ob_level;
	ob_start();
	$tcd_acceleration_ob_level = ob_get_level();

	// ob_startしてからアクション追加する
	add_action( 'shutdown', 'tcd_acceleration_ob_end', 1 );
}

/**
 * HTML操作するためのob_get_contents用関数
 *
 * @return void
 */
function tcd_acceleration_ob_end() {
	global $tcd_acceleration_ob_level;

	// tcd_acceleration_ob_start()後でなければ終了
	if ( ! $tcd_acceleration_ob_level )
		return;

	// tcd_acceleration_ob_start後のob_startがあればフラッシュする
	while ( ob_get_level() > $tcd_acceleration_ob_level ) {
		ob_end_flush();
	}

	if ( WP_DEBUG ) {
		$debug_massage = "\n<!-- Memory usage before filter: " . ( floor( memory_get_usage() / ( 1024 * 1024 ) * 1000 ) / 1000 )."MB -->";
	}

	// バッファー取得
	$html = ob_get_contents();
	ob_end_clean();

	// フィルター
	$html = apply_filters( 'tcd_acceleration_html', $html );

	if ( WP_DEBUG ) {
		$debug_massage .= "\n<!-- Memory usage after filter: " . ( floor( memory_get_usage() / ( 1024 * 1024 ) * 1000 ) / 1000 )."MB -->";
		$debug_massage = apply_filters( 'tcd_acceleration_debug_massage', $debug_massage );

		$html = rtrim( $html ) . $debug_massage;
	}

	echo $html;
}

/**
 * HTMLをDOMDocument化する関数
 *
 * @param string $html HTML
 * @return string HTML
 */
function tcd_acceleration_html_dom( $html ) {
	if ( class_exists( 'DOMDocument' ) ) {
		$doc = new DOMDocument( '1.0', 'UTF-8' );

		// DOMDocumentのエラーを出力しない
		libxml_use_internal_errors( true );

		// bodyを抽出
		if ( preg_match( '#^(.*?)(<body.*</body>)(.*)$#imsu', $html, $matches ) ) {
			$body = $matches[2];
		} else {
			$body = $html;
		}

		// 読み込み
		if ( defined( 'LIBXML_HTML_NOIMPLIED' ) && defined( 'LIBXML_HTML_NODEFDTD' ) ) {
			$doc->loadHTML( '<?xml encoding="UTF-8">' . mb_convert_encoding( $body, 'HTML-ENTITIES', 'UTF-8' ), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
		} else {
			$doc->loadHTML( '<?xml encoding="UTF-8">' . mb_convert_encoding( $body, 'HTML-ENTITIES', 'UTF-8' ) );
		}

		// 参照渡しでアクション
		do_action_ref_array( 'tcd_acceleration_html_dom', array( &$doc ) );

		// html出力
		$html = $doc->saveHTML( $doc->documentElement );

		// body前後を戻す
		if ( $matches ) {
			$html = $matches[1] . $html . $matches[3];
		}

		// ページビルダースライダーのjs内buttonの閉じタグが消える対策
		$html = str_replace( '\'<button type="button" class="slick-prev">&#xe90f;\',', '\'<button type="button" class="slick-prev">&#xe90f;</button>\',', $html );
		$html = str_replace( '\'<button type="button" class="slick-next">&#xe910;\',', '\'<button type="button" class="slick-next">&#xe910;</button>\',', $html );

		$html = apply_filters( 'tcd_acceleration_html_dom_after', $html );
	}

	return $html;
}

/**
 * lazyload用js
 *
 * @return void
 */
function tcd_acceleration_lazyload_scripts() {
	wp_enqueue_script( 'tcd-lazyload', get_template_directory_uri().'/js/lazyload.js', array(), version_num(), true );
}

/**
 * DOMDocumentから要素を検索してlazyload化
 *
 * @param DOMDocument $doc The DOMDocument instance.
 */
function tcd_acceleration_dom_lazyload( $doc ) {
	global $tcd_acceleration_lazyload_count, $tcd_acceleration_lazyload_exclude_id_class_names;
	$tcd_acceleration_lazyload_count = 0;

	if ( ! $doc || ! is_a( $doc, 'DOMDocument' ) )
		return;

	// slick等のsliderを除外するためimg検索ではなく親要素から順番に再帰的に判別していく

	// id名・クラス名に任意文字列が含まれる場合終了
	$tcd_acceleration_lazyload_exclude_id_class_names_default = array(
		'nolazy',
		'no-lazy',
		'wpadminbar',
		'slider',
		'carousel'
	);
	$tcd_acceleration_lazyload_exclude_id_class_names = apply_filters( 'tcd_acceleration_lazyload_exclude_id_class_names', $tcd_acceleration_lazyload_exclude_id_class_names_default );

	if ( empty( $tcd_acceleration_lazyload_exclude_id_class_names ) || ! is_array( $tcd_acceleration_lazyload_exclude_id_class_names ) )
		$tcd_acceleration_lazyload_exclude_id_class_names = $tcd_acceleration_lazyload_exclude_id_class_names_default;

	// <body>があれば<body>から、無ければ全体で再起処理開始
	$body = $doc->getElementsByTagName( 'body' );
	if ( 0 < $body->length ) {
		for ( $i = 0; $i < $body->length; $i++ ) {
			tcd_acceleration_dom_lazyload_sub( $body->item( $i ) );
		}
	} else {
		for ( $i = 0; $i < $doc->childNodes->length; $i++ ) {
			tcd_acceleration_dom_lazyload_sub( $doc->childNodes->item( $i ) );
		}
	}
}

/**
 * lazyload化の再起処理
 *
 * @param DOMElement $elem The DOMElement instance.
 */
function tcd_acceleration_dom_lazyload_sub( $elem ) {
	global $tcd_acceleration_lazyload_count, $tcd_acceleration_lazyload_exclude_id_class_names;

	if ( empty( $elem->tagName ) )
		return;

	// クラス名
	$class_name = trim( $elem->getAttribute( 'class' ) );

	// id名・クラス名に任意文字列が含まれる場合終了
	$id_class_name = $elem->getAttribute( 'id' ) . ' ' . $class_name;
	foreach ( $tcd_acceleration_lazyload_exclude_id_class_names as $value ) {
		if ( $value && false !== stripos( $id_class_name, $value ) ) {
			return;
		}
	}

	// <img>の場合
	if ( 'img' === $elem->tagName ) {
		$src = $elem->getAttribute( 'src' );
		if ( $src ) {
			$elem->setAttribute( 'class', $class_name . ' tcd-lazy' );
			$elem->setAttribute( 'data-src', $src );
			$elem->setAttribute( 'src', '' );

			if ( $elem->hasAttribute( 'srcset' ) ) {
				$elem->setAttribute( 'data-srcset', $elem->getAttribute( 'srcset' ) );
				$elem->setAttribute( 'data-sizes', $elem->getAttribute( 'sizes' ) );
				$elem->setAttribute( 'srcset', '' );
				$elem->setAttribute( 'sizes', '' );
			}

			$tcd_acceleration_lazyload_count++;
		}
	}

	// 背景画像ありの場合
	$style = $elem->getAttribute( 'style' );
	if ( preg_match( '#background(?:-image)?\s*:\s*url\((.*?)\)#', $style, $matches ) ) {
		$url = trim( $matches[1], '"\' ' );
		if ( $url ) {
			$elem->setAttribute( 'class', $class_name . ' tcd-lazy' );
			$elem->setAttribute( 'data-bg', 'url(' . $url . ')' );
			$elem->setAttribute( 'style', str_replace( $matches[1], '', $style ) );

			$tcd_acceleration_lazyload_count++;
		}
	}

	// 子要素が無ければ終了
	if ( ! $elem->hasChildNodes() )
		return;

	// 子要素再起
	for ( $i = 0; $i < $elem->childNodes->length; $i++ ) {
		if ( empty( $elem->childNodes->item( $i )->tagName ) )
			continue;

		if ( in_array( $elem->childNodes->item( $i )->tagName, array( 'html', 'head', 'script', 'style' ) ) )
			continue;

		tcd_acceleration_dom_lazyload_sub( $elem->childNodes->item( $i ) );
	}
}

/**
 * lazyload デバッグモードで置換数表示
 *
 * @param string $debug_massage
 */
function tcd_acceleration_lazyload_debug_massage( $debug_massage ) {
	global $tcd_acceleration_lazyload_count;

	$debug_massage .= "\n<!-- lazyload replace count: " . $tcd_acceleration_lazyload_count." -->";

	return $debug_massage;
}
