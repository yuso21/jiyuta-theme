<?php
if ( !defined( 'ABSPATH' ) ) exit;

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
<section class="daifuk-welcome-sec daifuk-section-white">
  <div class="daifuk-section-inner">
    <div class="daifuk-welcome-box">
      <span class="section-num" style="text-align: center; margin-bottom: 20px;">INTRODUCTION</span>
      <h2 class="daifuk-welcome-title">AI実験室へようこそ</h2>
      <div class="daifuk-welcome-text">
        <p class="daifuk-lead-text">AIは、本当に仕事で使えるのか。</p>
        <p>広告デザイナーがAIを実務で試し、<br>成功も失敗も公開する実験メディアです。</p>
        <p>その記録が、<strong>AI実験ノート</strong>です。</p>
      </div>
      <div style="text-align: center; margin-top: 40px;">
        <a href="<?php echo esc_url( $first_url ); ?>" class="daifuk-btn daifuk-btn-primary">連載を第1話から読む ➔</a>
      </div>
    </div>
  </div>
</section>
