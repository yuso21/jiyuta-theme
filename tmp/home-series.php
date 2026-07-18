<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$args = isset( $args ) && is_array( $args ) ? $args : array();
$slug = isset( $args['slug'] ) ? $args['slug'] : '';
$category = $slug ? get_category_by_slug( $slug ) : null;
if ( ! $category ) return;

$query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'cat'            => $category->term_id,
) );

$section_id = isset( $args['section_id'] ) ? $args['section_id'] : $slug;
$section_tone = isset( $args['tone'] ) && 'white' === $args['tone'] ? 'daifuk-section-white' : 'daifuk-section-gray';
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="daifuk-home-series <?php echo esc_attr( $section_tone ); ?>">
  <div class="daifuk-section-inner">
    <div class="section-header">
      <div class="header-left">
        <span class="section-num"><?php echo esc_html( $args['section_num'] ); ?></span>
        <div class="daifuk-home-series__title-row">
          <h2 class="section-title"><?php echo esc_html( $args['title'] ); ?></h2>
          <span class="daifuk-status-pill-mini">全<?php echo esc_html( number_format_i18n( $category->count ) ); ?>記事</span>
        </div>
        <p class="section-desc"><?php echo esc_html( $args['description'] ); ?></p>
      </div>
    </div>
    <div class="daifuk-grid-cocoon">
      <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php get_template_part( 'tmp/entry-card' ); ?>
      <?php endwhile; wp_reset_postdata(); else : ?>
        <p class="daifuk-home-series__empty">記事がありません。</p>
      <?php endif; ?>
    </div>
    <div class="daifuk-home-series__footer">
      <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="daifuk-btn daifuk-btn-primary">シリーズ一覧を見る →</a>
    </div>
  </div>
</section>
