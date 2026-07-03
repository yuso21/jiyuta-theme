<?php
if ( !defined( 'ABSPATH' ) ) exit;

$lab_cat = get_category_by_slug( 'ai-lab' );
if ( !$lab_cat ) {
    $lab_cat = get_category_by_slug( 'ai' );
}
$lab_link = $lab_cat ? get_category_link( $lab_cat->term_id ) : '#';

$lab_args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
);
if ( $lab_cat ) {
    $lab_args['cat'] = $lab_cat->term_id;
}

$lab_query = new WP_Query( $lab_args );

// 第1話（最古の投稿）のURLを取得するクエリ
$first_args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'order' => 'ASC',
    'post_status' => 'publish',
);
if ( $lab_cat ) {
    $first_args['cat'] = $lab_cat->term_id;
}
$first_query = new WP_Query( $first_args );
$first_link = '#';
if ( $first_query->have_posts() ) {
    while ( $first_query->have_posts() ) {
        $first_query->the_post();
        $first_link = get_permalink();
    }
    wp_reset_postdata();
}
?>
<section id="lab" class="daifuk-section-gray">
  <div class="section-header">
    <div class="header-left">
      <span class="section-num">02 / EXPERIMENT_LAB</span>
      <h2 class="section-title">AI実験室</h2>
      <p class="section-desc">技術やAIの活用プロセスを検証した、リアルな実験記録ログ。</p>
    </div>
    <div class="header-right">
      <a href="<?php echo esc_url( $first_link ); ?>" class="daifuk-header-link">第1話から読む ➔</a>
      <a href="<?php echo esc_url( $lab_link ); ?>" class="daifuk-header-link">すべて見る ➔</a>
    </div>
  </div>

  <div class="daifuk-grid-4">
    <?php if ( $lab_query->have_posts() ) : while ( $lab_query->have_posts() ) : $lab_query->the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="daifuk-card">
        <div class="daifuk-card-img-wrapper">
          <?php if ( has_post_thumbnail() ) : ?>
            <img class="daifuk-card-img" src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>">
          <?php else : ?>
            <div class="daifuk-card-img-placeholder" style="background-color: #f1f5f9; color: #94a3b8; text-align: center; padding: 20px;">
              [ <?php the_title(); ?> ]
            </div>
          <?php endif; ?>
        </div>
        <div class="daifuk-card-body">
          <div class="daifuk-card-meta">
            <?php 
            $exp_num = get_daifuk_experiment_number( get_the_ID() );
            if ( $exp_num ) : ?>
              <span class="daifuk-card-badge"><?php echo esc_html( $exp_num ); ?></span>
            <?php else : ?>
              <span><?php the_time( 'Y.m.d' ); ?></span>
            <?php endif; ?>
            <span>⏱️ <?php echo get_daifuk_reading_time( get_the_ID() ); ?></span>
          </div>
          <h3 class="daifuk-card-title"><?php the_title(); ?></h3>
          <div class="daifuk-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 40, '...' ); ?></div>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
      <p style="grid-column: 1 / -1; text-align: center; color: var(--text-muted);">記事がありません。</p>
    <?php endif; ?>
  </div>
</section>
