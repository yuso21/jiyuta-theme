<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

// 表示制御用の定数定義
define( 'TOP_EXPERIMENT_COUNT', 4 );
define( 'TOP_LATEST_COUNT', 5 );

// Cocoon標準カードのフックを利用して Experiment バッジを表示
function daifuk_add_experiment_badge_to_card( $post_id ) {
    $exp_num = get_daifuk_experiment_number( $post_id );
    if ( $exp_num ) {
        echo '<span class="daifuk-card-badge">' . esc_html( $exp_num ) . '</span>';
    }
}
add_action( 'entry_card_snippet_after', 'daifuk_add_experiment_badge_to_card' );

// カスタムホームページ用テンプレートが使われている時だけ、専用のCSSを読み込む
function enqueue_custom_home_styles() {
    if ( is_page_template( 'page-home-custom.php' ) ) {
        wp_enqueue_style(
            'custom-home-styles',
            get_stylesheet_directory_uri() . '/css/custom-home.css',
            array(),
            '1.0.0'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_home_styles' );

// ⏱️ 記事の本文文字数から想定読了時間を計算する関数
function get_daifuk_reading_time( $post_id ) {
    $post = get_post( $post_id );
    if ( !$post ) return '1分';
    $content = strip_shortcodes( $post->post_content );
    $content = strip_tags( $content );
    $char_count = mb_strlen( preg_replace( '/\s+/', '', $content ) );
    // 1分間あたり600文字で読むと仮定して算出
    $minutes = ceil( $char_count / 600 );
    if ( $minutes < 1 ) $minutes = 1;
    return $minutes . '分';
}

// 🔢 記事タイトルから「#XX」を抽出するか、カスタムフィールドを元に連載番号（Experiment #00X）を生成する関数
function get_daifuk_experiment_number( $post_id ) {
    // 1. カスタムフィールド 'experiment_number' をチェック
    $num = get_post_meta( $post_id, 'experiment_number', true );
    if ( $num ) {
        return 'Experiment #' . sprintf( '%03d', intval( $num ) );
    }
    // 2. 記事タイトル内の #XX または #X パターンを検索 (HTMLエンティティ&#8221;等の誤検知を防ぐためデコードと否定後方参照を追加)
    $title = get_the_title( $post_id );
    $title_decoded = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
    if ( preg_match( '/(?<!&)(?:#|Vol\.?\s*)([0-9]+)/i', $title_decoded, $matches ) ) {
        return 'Experiment #' . sprintf( '%03d', intval( $matches[1] ) );
    }
    // 3. マッチしない場合は空文字を返す（フォールバック）
    return '';
}

// 🌐 カスタムOGP画像の適用（ホームページのみ）
function daifuk_custom_ogp_image( $ogp_image ) {
    if ( is_front_page() || is_page_template( 'page-home-custom.php' ) ) {
        return get_stylesheet_directory_uri() . '/images/jiyuta_OGP.png';
    }
    return $ogp_image;
}
add_filter( 'ogp_card_ogp_image', 'daifuk_custom_ogp_image' );

// 🎯 ファビコン（Favicon）の強制適用
function daifuk_custom_favicon() {
    $favicon_url = get_stylesheet_directory_uri() . '/images/jiyuta_fabicon.png';
    echo '<link rel="icon" href="' . esc_url( $favicon_url ) . '" type="image/png" />' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url( $favicon_url ) . '" />' . "\n";
}
add_action( 'wp_head', 'daifuk_custom_favicon', 1 );