<?php
if ( !defined( 'ABSPATH' ) ) exit;

// 最古の投稿 (第1話) のURLを取得するクエリ
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
<section class="daifuk-hero">
  <div class="daifuk-hero-overlay"></div>
  <div class="daifuk-hero-content daifuk-fade-in">
    <h1 class="daifuk-hero-title">AIを、仕事の武器に。</h1>
    <p class="daifuk-hero-subtitle">デザイナーが実際に試したAI活用・Web制作・デザインの実験記録。</p>
    <div class="daifuk-hero-ctas">
      <a href="#lab" class="daifuk-btn daifuk-btn-primary">最新の実験を見る</a>
      <a href="<?php echo esc_url( $first_url ); ?>" class="daifuk-btn daifuk-btn-secondary">第1話から読む</a>
    </div>
  </div>
</section>
