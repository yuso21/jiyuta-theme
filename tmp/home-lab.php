<?php
if ( !defined( 'ABSPATH' ) ) exit;

$lab_cat = get_category_by_slug( 'ai-lab' );
$lab_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
);
if ( $lab_cat ) {
    $lab_args['cat'] = $lab_cat->term_id;
}

$lab_query = new WP_Query( $lab_args );
?>
<section id="lab">
  <div class="section-header">
    <span class="section-num">01 / LATEST_EXPERIMENTS</span>
    <h2 class="section-title">AI実験室</h2>
    <p class="section-desc">技術やAIの活用プロセスを検証した、リアルな実験記録ログ。</p>
  </div>

  <div class="daifuk-grid-3">
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
            <span>SYS_TIME: <?php the_time( 'Y.m.d' ); ?></span>
            <span>TAG: <?php 
              $tags = get_the_tags();
              echo $tags ? esc_html( $tags[0]->name ) : 'AI活用'; 
            ?></span>
          </div>
          <h3 class="daifuk-card-title"><?php the_title(); ?></h3>
          <div class="daifuk-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 45, '...' ); ?></div>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
      <p style="grid-column: 1 / -1; text-align: center; color: var(--text-muted);">最新記事がありません。「ai-lab」または通常の投稿を作成してください。</p>
    <?php endif; ?>
  </div>
</section>
