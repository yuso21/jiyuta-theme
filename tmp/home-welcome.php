<?php
if ( !defined( 'ABSPATH' ) ) exit;

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
        if ( preg_match( '/#([0-9]+)/', $title, $matches ) ) {
            $val = intval( $matches[1] );
            if ( $val > $max_num ) {
                $max_num = $val;
            }
        }
    }
    wp_reset_postdata();
}
$formatted_max = sprintf( '#%03d', $max_num );

// 第1話 (最古の投稿) のURLを取得するクエリ
$first_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'category_name'  => 'ai-lab',
);
$first_query = new WP_Query( $first_args );
$first_url = '#';
if ( $first_query->have_posts() ) {
    while ( $first_query->have_posts() ) {
        $first_query->the_post();
        $first_url = get_permalink();
    }
    wp_reset_postdata();
}
?>
<section class="daifuk-section-white daifuk-welcome-sec">
  <div class="daifuk-section-inner">
    <div class="daifuk-welcome-box">
      <span class="section-num" style="text-align: center; margin-bottom: 20px;">INTRODUCTION</span>
      <h2 class="daifuk-welcome-title">AI実験室へようこそ。</h2>
      <div class="daifuk-welcome-text">
        <p class="daifuk-lead-text">AIは、本当に仕事で使えるのか。</p>
        <p>広告デザイナーが生成AIを実際のクリエイティブ業務で使い、<br>その成功も失敗も包み隠さずそのまま公開している実験メディアです。</p>
        <p>その詳細なドキュメントが、連載シリーズ<strong>「AI実験ノート」</strong>です。</p>
        <p class="daifuk-status-pill">現在 <span>Experiment <?php echo esc_html( $formatted_max ); ?></span> まで公開中</p>
      </div>
      <div style="text-align: center; margin-top: 40px;">
        <a href="<?php echo esc_url( $first_url ); ?>" class="daifuk-btn daifuk-btn-primary">連載を第1話から読み進める ➔</a>
      </div>
    </div>
  </div>
</section>
