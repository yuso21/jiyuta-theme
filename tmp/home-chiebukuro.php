<?php
if ( !defined( 'ABSPATH' ) ) exit;

$notes_cat = get_category_by_slug( 'ai-chiebukuro' );
if ( !$notes_cat ) {
    $notes_cat = get_category_by_slug( 'ai-notes' );
}

$notes_args = array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'post_status' => 'publish',
);
if ( $notes_cat ) {
    $notes_args['cat'] = $notes_cat->term_id;
} else {
    $notes_args['offset'] = 3;
}

$notes_query = new WP_Query( $notes_args );
$has_notes = $notes_query->have_posts() && $notes_cat; // Only query dynamic notes if category exists
?>
<section id="notes">
  <div class="section-header">
    <span class="section-num">02 / KNOWLEDGE_BASE</span>
    <h2 class="section-title">AI先生の知恵袋</h2>
    <p class="section-desc">AIとの壁打ちから得た、再利用可能な実践的チップスと解説図解。</p>
  </div>

  <div class="daifuk-grid-2">
    <?php if ( $has_notes ) : while ( $notes_query->have_posts() ) : $notes_query->the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="daifuk-note-card">
        <div class="daifuk-note-card-title">💡 AI先生の知恵袋</div>
        <div class="daifuk-note-card-body">
          <p><strong>テーマ: <?php the_title(); ?></strong></p>
          <?php if ( has_post_thumbnail() ) : ?>
            <div class="daifuk-note-card-img-placeholder" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>); background-size: cover; background-position: center; height: 160px;"></div>
          <?php else : ?>
            <div class="daifuk-note-card-img-placeholder">[解説図解イメージ: <?php the_title(); ?>]</div>
          <?php endif; ?>
          <p><?php echo wp_trim_words( get_the_excerpt(), 50, '...' ); ?></p>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
      <!-- Static placeholder if empty -->
      <div class="daifuk-note-card">
        <div class="daifuk-note-card-title">💡 AI先生の知恵袋</div>
        <div class="daifuk-note-card-body">
          <p><strong>テーマ: プロンプトデザインにおけるコンテキスト設計</strong></p>
          <div class="daifuk-note-card-img-placeholder">[プロンプト入力コンテキストの関連図]</div>
          <p>AIへの指示を行う際、役割の定義・入力パラメータ・出力形式の指定が正しく連携することで、意図に100%沿った正確な返答を導き出す関連図を示しています。</p>
        </div>
      </div>
      <div class="daifuk-note-card">
        <div class="daifuk-note-card-title">💡 AI先生の知恵袋</div>
        <div class="daifuk-note-card-body">
          <p><strong>テーマ: AI技術が私たちの生活や仕事にどのように貢献しているか</strong></p>
          <div class="daifuk-note-card-img-placeholder">[AIによるプロセス自動化フロー図]</div>
          <p>このフローでは、データの入力からAIアルゴリズムによる分析、そして最適化されたアウトプットが生成されるまでのプロセス全体を視覚化しています。</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>
