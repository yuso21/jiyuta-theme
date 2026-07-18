<?php
if ( !defined( 'ABSPATH' ) ) exit;

$latest_args = array(
    'post_type'      => 'post',
    'posts_per_page' => TOP_LATEST_COUNT,
    'post_status'    => 'publish',
);
$latest_query = new WP_Query( $latest_args );

$latest_link = home_url( '/' );

// もし記事が全くない場合はセクションごと表示しない
if ( $latest_query->have_posts() ) :
?>
<section id="latest-news" class="daifuk-section-white">
  <div class="daifuk-section-inner">
    <div class="section-header">
      <div class="header-left">
        <span class="section-num">06 / RECENT_UPDATES</span>
        <h2 class="section-title">最近の更新</h2>
        <p class="section-desc">AI実験室の新しい記録と、最近公開した記事。</p>
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
      <a href="<?php echo esc_url( $latest_link ); ?>" class="daifuk-btn daifuk-btn-secondary" style="margin-left:0;">もっと見る ➔</a>
    </div>
  </div>
</section>
<?php endif; ?>
