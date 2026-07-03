<?php
if ( !defined( 'ABSPATH' ) ) exit;

$latest_args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
);
$latest_query = new WP_Query( $latest_args );
?>
<section id="latest-logs" class="daifuk-section-white">
  <div class="section-header">
    <div class="header-left">
      <span class="section-num">01 / NEW_LOGS</span>
      <h2 class="section-title">最新記事</h2>
      <p class="section-desc">jiyuta.comで公開された、すべてのカテゴリの最新の活動記録。</p>
    </div>
  </div>

  <div class="daifuk-grid-4">
    <?php if ( $latest_query->have_posts() ) : while ( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
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
            <span><?php the_time( 'Y.m.d' ); ?></span>
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
