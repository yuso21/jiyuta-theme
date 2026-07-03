<?php
/**
 * Template Name: Custom Home (AI実験室)
 * Description: AI実験室・DAIFUK戦記のメディア型トップページ用カスタムテンプレート
 */

if ( !defined( 'ABSPATH' ) ) exit;

get_header();
?>

<!-- AI実験室 メディア型トップページコンテナ -->
<div id="content" class="content cf daifuk-home-layout">
  <div id="main" class="main" role="main">
    
    <?php
    // ① HEROセクション（最上部 - パララックス対応）
    get_template_part( 'tmp/home-hero' );

    // ② ブランド紹介セクション（AI実験室へようこそ）
    get_template_part( 'tmp/home-welcome' );

    // ③ AI実験ノート（カテゴリ最新4件 ＋ バッジ）
    get_template_part( 'tmp/home-lab' );

    // ④ 最新記事（他カテゴリの最新5件テキストフィード）
    get_template_part( 'tmp/home-latest' );

    // ⑤ プロフィール（左右分割）
    get_template_part( 'tmp/home-profile' );

    // ⑥ お問い合わせ（案内バッジ付き）
    get_template_part( 'tmp/home-contact' );

    // ⑦⑧⑨ 検索・カテゴリー・タグ（最下部フッターナビゲーション）
    get_template_part( 'tmp/home-search-tags' );


    ?>

  </div><!-- /#main -->
</div><!-- /#content -->

<?php
get_footer();
?>
