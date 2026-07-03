<?php
if ( !defined( 'ABSPATH' ) ) exit;

// 想定するカテゴリーのマッピング（スラッグ => 表示名 と 絵文字）
$cats_mapping = array(
    'ai-lab' => array('name' => 'AI実験室', 'icon' => '🧪', 'fallback' => 'ai'),
    'ai-chiebukuro' => array('name' => 'AI先生の知恵袋', 'icon' => '💡', 'fallback' => 'ai-notes'),
    'web-creation' => array('name' => 'Web制作', 'icon' => '💻', 'fallback' => 'programming'),
    'design' => array('name' => 'デザイン', 'icon' => '🎨', 'fallback' => 'pleasant'),
    'blog-management' => array('name' => 'ブログ運営', 'icon' => '📝', 'fallback' => 'useful')
);
?>
<section id="categories">
  <div class="section-header">
    <span class="section-num">04 / DISCOVER_BY_CATEGORY</span>
    <h2 class="section-title">カテゴリーから探す</h2>
    <p class="section-desc">実験テーマに合わせた各カテゴリーごとのログ一覧。</p>
  </div>

  <div class="daifuk-grid-5">
    <?php foreach ( $cats_mapping as $slug => $data ) : 
      $cat = get_category_by_slug( $slug );
      if ( !$cat && isset( $data['fallback'] ) ) {
          $cat = get_category_by_slug( $data['fallback'] );
      }
      $cat_link = $cat ? get_category_link( $cat->term_id ) : '#';
      $cat_name = $cat ? $cat->name : $data['name'];
      ?>
      <a href="<?php echo esc_url( $cat_link ); ?>" class="daifuk-cat-card">
        <div class="daifuk-cat-icon"><?php echo esc_html( $data['icon'] ); ?></div>
        <span class="daifuk-cat-name"><?php echo esc_html($cat_name); ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</section>
