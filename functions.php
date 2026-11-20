<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

// 配布用チェックリストなどのMarkdownファイルをメディアへアップロードできるようにする。
function daifuk_allow_markdown_uploads( $mimes ) {
    // WordPress/PHP identifies Markdown files as text/plain during upload.
    $mimes['md'] = 'text/plain';
    return $mimes;
}
add_filter( 'upload_mimes', 'daifuk_allow_markdown_uploads' );

// Markdownは nginx の静的配信では文字コードが付かないため、UTF-8を明示して配布する。
function daifuk_serve_markdown_download() {
    if ( ! isset( $_GET['download_markdown'] ) ) {
        return;
    }

    $attachment_id = absint( $_GET['download_markdown'] );
    $file_path     = get_attached_file( $attachment_id );

    if ( ! $attachment_id || ! $file_path || ! is_readable( $file_path ) || 'md' !== pathinfo( $file_path, PATHINFO_EXTENSION ) ) {
        status_header( 404 );
        exit;
    }

    nocache_headers();
    header( 'Content-Type: text/markdown; charset=UTF-8' );
    header( 'Content-Disposition: attachment; filename="' . rawurlencode( basename( $file_path ) ) . '"' );
    header( 'Content-Length: ' . filesize( $file_path ) );
    readfile( $file_path );
    exit;
}
add_action( 'template_redirect', 'daifuk_serve_markdown_download' );

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

// 記事内のプロンプトを読みやすく表示し、ワンクリックでコピーできるようにする。
function daifuk_enqueue_prompt_copy_assets() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    wp_enqueue_style(
        'daifuk-prompt-copy',
        get_stylesheet_directory_uri() . '/css/prompt-copy.css',
        array(),
        '1.0.0'
    );
    wp_enqueue_script(
        'daifuk-prompt-copy',
        get_stylesheet_directory_uri() . '/js/prompt-copy.js',
        array(),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'daifuk_enqueue_prompt_copy_assets' );

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
    // 2. 記事タイトル内の #XX または #X パターンを検索 (HTMLエンティティ&#8221;等の誤検知を防ぐためデコードと否定後方参照を追加)
    // 3. マッチしない場合は空文字を返す（フォールバック）
    // 番号の判定は、シリーズ機能の共通処理（メタ → スラッグ → タイトル）に集約する。
    $number = function_exists( 'daifuk_get_series_number' ) ? daifuk_get_series_number( $post_id ) : null;
    return null === $number ? '' : 'Experiment #' . sprintf( '%03d', $number );
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

// 🎯 REST APIでYoast SEOおよびRank Mathのメタキーを更新可能にする設定
function daifuk_register_seo_meta_in_rest() {
    $meta_keys = [
        '_yoast_wpseo_title',
        '_yoast_wpseo_metadesc',
        '_yoast_wpseo_focuskw',
        'rank_math_title',
        'rank_math_description',
        'rank_math_focus_keyword',
        'the_page_seo_title',
        'the_page_meta_description'
    ];
    foreach ( $meta_keys as $key ) {
        register_post_meta( 'post', $key, array(
            'show_in_rest' => true,
            'single'       => true,
            'type'         => 'string',
            'auth_callback' => function() {
                return current_user_can( 'edit_posts' );
            }
        ) );
    }
}
add_action( 'rest_api_init', 'daifuk_register_seo_meta_in_rest' );

// robots.txtでは、実際に利用しているXMLサイトマップだけを案内する。
// WordPress標準の空サイトマップやHTML版サイトマップが重複して出ないように整える。
function daifuk_normalize_robots_sitemap( $output, $public ) {
    if ( ! $public ) {
        return $output;
    }

    $output = preg_replace( '/^\s*Sitemap:\s*.*$/mi', '', $output );
    $output = trim( preg_replace( "/\n{3,}/", "\n\n", $output ) );

    return $output . "\n\nSitemap: " . home_url( '/sitemap.xml' ) . "\n";
}
add_filter( 'robots_txt', 'daifuk_normalize_robots_sitemap', 999, 2 );

// XML Sitemap Generatorがdo_robotsで同じURLとHTML版を後から追記する処理を止める。
function daifuk_disable_sitemap_plugin_robots_append() {
    remove_action(
        'do_robots',
        array( 'GoogleSitemapGeneratorLoader', 'call_do_robots' ),
        100
    );
}
add_action( 'init', 'daifuk_disable_sitemap_plugin_robots_append', 1 );

require_once get_stylesheet_directory() . '/inc/series-core.php';
require_once get_stylesheet_directory() . '/inc/series-navigation.php';
require_once get_stylesheet_directory() . '/inc/series-archive.php';
