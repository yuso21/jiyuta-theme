<?php
if ( !defined( 'ABSPATH' ) ) exit;

// 1. タグ「recommended」または「featured」が付いた記事を優先して取得
$rec_tag = get_term_by( 'slug', 'recommended', 'post_tag' );
if ( !$rec_tag ) {
    $rec_tag = get_term_by( 'slug', 'featured', 'post_tag' );
}

$rec_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
);

if ( $rec_tag ) {
    $rec_args['tag_id'] = $rec_tag->term_id;
} else {
    // フォールバック1: 固定記事（Sticky Posts）を取得
    $sticky = get_option( 'sticky_posts' );
    if ( !empty( $sticky ) ) {
        $rec_args['post__in'] = $sticky;
        $rec_args['ignore_sticky_posts'] = 1;
    } else {
        // フォールバック2: 一般投稿（全件）から最新3件
        $rec_args['orderby'] = 'date';
    }
}

$rec_query = new WP_Query( $rec_args );
?>
<section id="recommended" class="daifuk-section-blue">
  <div class="section-header">
    <div class="header-left">
      <span class="section-num">04 / RECOMMENDED_LOGS</span>
      <h2 class="section-title">編集部おすすめ記事</h2>
      <p class="section-desc">AI実験室を初めて訪れた方におすすめの、基本・厳選ログ。</p>
    </div>
  </div>

  <div class="daifuk-grid-3">
    <?php if ( $rec_query->have_posts() ) : while ( $rec_query->have_posts() ) : $rec_query->the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="daifuk-card">
        <div class="daifuk-card-img-wrapper">
          <?php if ( has_post_thumbnail() ) : ?>
            <img class="daifuk-card-img" src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>">
          <?php else : ?>
            <div class="daifuk-card-img-placeholder" style="background-color: #e0f2fe; color: #0369a1; text-align: center; padding: 20px;">
              [ <?php the_title(); ?> ]
            </div>
          <?php endif; ?>
        </div>
        <div class="daifuk-card-body">
          <div class="daifuk-card-meta">
            <span><?php the_time( 'Y.m.d' ); ?></span>
            <span>⏱️ <?php echo get_daifuk_reading_time( get_the_ID() ); ?></span>
          </div>
          <h3 class="daifuk-card-title"><?php the_title(); ?></h3>
          <div class="daifuk-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 45, '...' ); ?></div>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
      <p style="grid-column: 1 / -1; text-align: center; color: var(--text-muted);">おすすめ記事がありません。</p>
    <?php endif; ?>
  </div>
</section>
