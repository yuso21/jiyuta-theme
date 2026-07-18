<?php
if ( !defined( 'ABSPATH' ) ) exit;

$lab_category = get_category_by_slug( 'ai-lab' );
$lab_link = $lab_category ? get_category_link( $lab_category->term_id ) : '#';
?>
<section class="daifuk-hero">
  <div class="daifuk-hero-overlay"></div>
  <div class="daifuk-hero-content daifuk-fade-in">
    <h1 class="daifuk-hero-title"><span class="daifuk-highlight">AI</span>を、仕事の武器に。</h1>
    <p class="daifuk-hero-subtitle"><span>広告デザイナーが、</span><span>AIを実務で試し、</span><span>成功も失敗も公開する実験メディア。</span></p>
    <div class="daifuk-hero-ctas">
      <a href="<?php echo esc_url( $lab_link ); ?>" class="daifuk-btn daifuk-btn-primary">AI実験ノートを見る</a>
    </div>
  </div>
</section>
