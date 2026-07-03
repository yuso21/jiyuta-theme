<?php
if ( !defined( 'ABSPATH' ) ) exit;

$notes_cat = get_category_by_slug( 'ai-chiebukuro' );
if ( !$notes_cat ) {
    $notes_cat = get_category_by_slug( 'ai-notes' );
}
$notes_link = $notes_cat ? get_category_link( $notes_cat->term_id ) : '#';

$notes_args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
);
if ( $notes_cat ) {
    $notes_args['cat'] = $notes_cat->term_id;
} else {
    $notes_args['offset'] = 4;
}

$notes_query = new WP_Query( $notes_args );
?>
<section id="notes" class="daifuk-section-white">
  <div class="section-header">
    <div class="header-left">
      <span class="section-num">03 / KNOWLEDGE_BASE</span>
      <h2 class="section-title">AI先生の知恵袋</h2>
      <p class="section-desc">AIとの壁打ちから得た、再利用可能な実践的チップスと解説図解。</p>
    </div>
    <div class="header-right">
      <a href="<?php echo esc_url( $notes_link ); ?>" class="daifuk-header-link">すべて見る ➔</a>
    </div>
  </div>

  <div class="daifuk-grid-2">
    <?php if ( $notes_query->have_posts() ) : while ( $notes_query->have_posts() ) : $notes_query->the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="daifuk-note-card">
        <div class="daifuk-note-card-title">💡 AI先生の知恵袋</div>
        <div class="daifuk-note-card-body">
          <p><strong>テーマ: <?php the_title(); ?></strong></p>
          <?php if ( has_post_thumbnail() ) : ?>
            <div class="daifuk-note-card-img-placeholder" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>); background-size: cover; background-position: center; height: 160px; border-radius: 8px;"></div>
          <?php endif; ?>
          <p><?php echo wp_trim_words( get_the_excerpt(), 60, '...' ); ?></p>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
      <p style="grid-column: 1 / -1; text-align: center; color: var(--text-muted);">記事がありません。</p>
    <?php endif; ?>
  </div>
</section>
