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
    // ① HEROセクション（最上部）
    get_template_part( 'tmp/home-hero' );

    // ② 最新記事（NEW - 全カテゴリ最新4件）
    get_template_part( 'tmp/home-latest' );

    // ③ AI実験室（「AI実験室」カテゴリ最新4件）
    get_template_part( 'tmp/home-lab' );

    // ④ AI先生の知恵袋（「AI先生の知恵袋」カテゴリ最新4件）
    get_template_part( 'tmp/home-chiebukuro' );

    // ⑤ おすすめ記事（タグ・固定記事制御）
    get_template_part( 'tmp/home-recommended' );

    // ⑥ カテゴリー（5大カテゴリ）
    get_template_part( 'tmp/home-categories' );

    // ⑦ プロフィール（左右反転・詳細ボタン）
    get_template_part( 'tmp/home-profile' );

    // ⑧ お問い合わせ（プレゼンス強化）
    get_template_part( 'tmp/home-contact' );

    ?>

  </div><!-- /#main -->
</div><!-- /#content -->

<?php
get_footer();
?>
