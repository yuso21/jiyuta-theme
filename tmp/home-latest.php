<?php
if ( !defined( 'ABSPATH' ) ) exit;

// AI実験ノートのカテゴリIDを取得して除外する
$lab_cat = get_category_by_slug( 'ai-lab' );
if ( !$lab_cat ) {
    $lab_cat = get_category_by_slug( 'ai-jikken-note' );
}
$exclude_cat = $lab_cat ? $lab_cat->term_id : 0;

$latest_args = array(
    'post_type'        => 'post',
    'posts_per_page'   => TOP_LATEST_COUNT,
    'post_status'      => 'publish',
    'category__not_in' => array( $exclude_cat ),
);
$latest_query = new WP_Query( $latest_args );

// もし記事が全くない場合はセクションごと表示しない
if ( $latest_query->have_posts() ) :
?>
<section id="latest-news" class="daifuk-section-white">
  <div class="section-header">
    <div class="header-left">
      <span class="section-num">04 / OTHER_LOGS</span>
      <h2 class="section-title">その他の最新記事</h2>
      <p class="section-desc">AI実験ノート以外のカテゴリー（3DCG、Web制作、プログラミング等）の最新ログ。</p>
    </div>
    <div class="header-right">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="daifuk-header-link">もっと見る ➔</a>
    </div>
  </div>

  <div class="daifuk-latest-list">
    <?php while ( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="daifuk-latest-item">
        <span class="daifuk-latest-date"><?php the_time( 'Y.m.d' ); ?></span>
        <span class="daifuk-latest-title"><?php the_title(); ?></span>
        <span class="daifuk-latest-arrow">➔</span>
      </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>

  <div style="text-align: center; margin-top: 40px;">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="daifuk-btn daifuk-btn-secondary" style="margin-left:0;">もっと見る ➔</a>
  </div>
</section>
<?php endif; ?>
