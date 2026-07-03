<?php
if ( !defined( 'ABSPATH' ) ) exit;

$lab_cat = get_category_by_slug( 'ai-lab' );
if ( !$lab_cat ) {
    $lab_cat = get_category_by_slug( 'ai-jikken-note' );
}
if ( !$lab_cat ) {
    $lab_cat = get_category_by_slug( 'ai' );
}
$lab_link = $lab_cat ? get_category_link( $lab_cat->term_id ) : '#';

$lab_args = array(
    'post_type'      => 'post',
    'posts_per_page' => TOP_EXPERIMENT_COUNT,
    'post_status'    => 'publish',
);
if ( $lab_cat ) {
    $lab_args['cat'] = $lab_cat->term_id;
}

$lab_query = new WP_Query( $lab_args );

// 最も大きな連載番号を動的に取得する
$max_exp_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 10,
    'post_status'    => 'publish',
    'category_name'  => 'ai-lab',
);
$max_query = new WP_Query( $max_exp_args );
$max_num = 1;
if ( $max_query->have_posts() ) {
    while ( $max_query->have_posts() ) {
        $max_query->the_post();
        $title = get_the_title();
        $title_decoded = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
        if ( preg_match( '/(?<!&)#([0-9]+)/', $title_decoded, $matches ) ) {
            $val = intval( $matches[1] );
            if ( $val > $max_num ) {
                $max_num = $val;
            }
        }
    }
    wp_reset_postdata();
}
$formatted_max = sprintf( '#%03d', $max_num );
?>
<section id="lab" class="daifuk-section-gray">
  <div class="daifuk-section-inner">
    <div class="section-header">
      <div class="header-left">
        <span class="section-num">03 / MAIN_SERIES</span>
        <div style="display: flex; align-items: baseline; gap: 16px; flex-wrap: wrap;">
          <h2 class="section-title">AI実験ノート</h2>
          <span class="daifuk-status-pill-mini">現在公開中 Experiment <?php echo esc_html( $formatted_max ); ?></span>
        </div>
        <p class="section-desc">AIを実際の仕事で使用したプロセス、成功と失敗の完全な実験記録。</p>
      </div>
      <div class="header-right">
        <a href="<?php echo esc_url( $lab_link ); ?>" class="daifuk-header-link">すべて見る ➔</a>
      </div>
    </div>

    <div class="daifuk-grid-cocoon">
      <?php if ( $lab_query->have_posts() ) : while ( $lab_query->have_posts() ) : $lab_query->the_post(); ?>
        <?php 
        // Cocoon標準のエントリーカードテンプレートを安全に読み込み
        get_template_part( 'tmp/entry-card' ); 
        ?>
      <?php endwhile; wp_reset_postdata(); else : ?>
        <p style="grid-column: 1 / -1; text-align: center; color: var(--text-muted);">記事がありません。</p>
      <?php endif; ?>
    </div>

    <div style="text-align: center; margin-top: 50px;">
      <a href="<?php echo esc_url( $lab_link ); ?>" class="daifuk-btn daifuk-btn-primary">もっと見る ➔</a>
    </div>
  </div>
</section>
