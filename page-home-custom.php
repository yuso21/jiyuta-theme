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

    // ② 3つのシリーズ案内
    get_template_part( 'tmp/home-series-guide' );

    // ③ AI実験ノート
    get_template_part( 'tmp/home-lab' );

    // ④ AIと働く
    get_template_part( 'tmp/home-series', null, array(
      'slug'        => 'ai-work',
      'section_id'  => 'ai-work',
      'section_num' => '04 / SERIES',
      'title'       => 'AIと働く',
      'description' => 'AI時代の働き方や、人との関わりを綴るエッセイシリーズ。',
      'tone'        => 'white',
    ) );

    // ⑤ デザインとAI
    get_template_part( 'tmp/home-series', null, array(
      'slug'        => 'design-ai',
      'section_id'  => 'design-ai',
      'section_num' => '05 / SERIES',
      'title'       => 'デザインとAI',
      'description' => 'デザインの視点から、AIとの付き合い方を考えるシリーズ。',
      'tone'        => 'gray',
    ) );

    // ⑥ プロフィール（左右分割）
    get_template_part( 'tmp/home-profile' );

    // ⑦ お問い合わせ（案内バッジ付き）
    get_template_part( 'tmp/home-contact' );

    // ⑧ 最近の更新
    get_template_part( 'tmp/home-latest' );

    // ⑨ 検索・カテゴリー・タグ（最下部フッターナビゲーション）
    get_template_part( 'tmp/home-search-tags' );


    ?>

  </div><!-- /#main -->
</div><!-- /#content -->

<?php
get_footer();
?>
