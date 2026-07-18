<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$series_items = array(
    array( 'slug' => 'ai-lab', 'title' => 'AI実験ノート', 'description' => 'AIを実務で試した、成功と失敗の実験記録。' ),
    array( 'slug' => 'ai-work', 'title' => 'AIと働く', 'description' => 'AI時代の働き方と、人との関わりを考える。' ),
    array( 'slug' => 'design-ai', 'title' => 'デザインとAI', 'description' => 'デザインの視点からAIとの対話を探る。' ),
);
?>
<section class="daifuk-series-guide daifuk-section-white" aria-labelledby="series-guide-title">
  <div class="daifuk-section-inner">
    <div class="section-header">
      <div class="header-left">
        <span class="section-num">03 / SERIES GUIDE</span>
        <h2 id="series-guide-title" class="section-title">3つのシリーズ</h2>
        <p class="section-desc">気になるテーマから、AI実験室の記録を読み始められます。</p>
      </div>
    </div>
    <div class="daifuk-series-guide__list">
      <?php foreach ( $series_items as $series_item ) : ?>
        <?php $category = get_category_by_slug( $series_item['slug'] ); ?>
        <?php if ( $category ) : ?>
          <a class="daifuk-series-guide__item" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
            <span class="daifuk-series-guide__title"><?php echo esc_html( $series_item['title'] ); ?></span>
            <span class="daifuk-series-guide__description"><?php echo esc_html( $series_item['description'] ); ?></span>
            <span class="daifuk-series-guide__link">シリーズ一覧を見る →</span>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
