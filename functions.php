<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

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