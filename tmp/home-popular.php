<?php
if ( !defined( 'ABSPATH' ) ) exit;

// 手動で指定したい固定記事のIDがあれば、配列に入力します。（例: array(3651, 3591, 3311)）
$featured_ids = array(); 

$popular_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
);

if ( !empty( $featured_ids ) ) {
    $popular_args['post__in'] = $featured_ids;
    $popular_args['orderby'] = 'post__in';
} else {
    $popular_args['orderby'] = 'comment_count';
}

$popular_query = new WP_Query( $popular_args );
?>
<section id="popular">
  <div class="section-header">
    <span class="section-num">03 / FEATURED_LOGS</span>
    <h2 class="section-title">人気記事</h2>
    <p class="section-desc">読者の方々に多く読まれている、おすすめの実験記録。</p>
  </div>

  <div class="daifuk-grid-3">
    <?php if ( $popular_query->have_posts() ) : while ( $popular_query->have_posts() ) : $popular_query->the_post(); ?>
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
            <span>SYS_TIME: <?php the_time( 'Y.m.d' ); ?></span>
            <span>TAG: <?php 
              $tags = get_the_tags();
              echo $tags ? esc_html( $tags[0]->name ) : '人気ログ'; 
            ?></span>
          </div>
          <h3 class="daifuk-card-title"><?php the_title(); ?></h3>
          <div class="daifuk-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 45, '...' ); ?></div>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
      <p style="grid-column: 1 / -1; text-align: center; color: var(--text-muted);">記事がありません。</p>
    <?php endif; ?>
  </div>
</section>
