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

    // ② AI実験室（最新記事）
    get_template_part( 'tmp/home-lab' );

    // ③ AI先生の知恵袋（図解シリーズ）
    get_template_part( 'tmp/home-chiebukuro' );

    // ④ 人気記事（固定記事）
    get_template_part( 'tmp/home-popular' );

    // ⑤ カテゴリー（アイコン付きカード）
    get_template_part( 'tmp/home-categories' );

    // ⑥ プロフィール（シンプルに整理）
    get_template_part( 'tmp/home-profile' );

    // ⑦ お問い合わせ（自然な案内）
    get_template_part( 'tmp/home-contact' );
    ?>

  </div><!-- /#main -->
</div><!-- /#content -->

<?php
get_footer();
?>
