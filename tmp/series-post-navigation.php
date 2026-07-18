<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$series = daifuk_get_post_series();
$neighbors = daifuk_get_series_neighbors();
$category = $series ? get_category_by_slug( $series['slug'] ) : null;
if ( ! $series || ! $category ) return;
?>
<nav class="daifuk-series-navigation" aria-label="<?php echo esc_attr( $series['name'] ); ?>の記事ナビゲーション">
  <div class="daifuk-series-navigation__header">
    <span class="daifuk-series-navigation__eyebrow"><?php echo esc_html( $series['name'] ); ?></span>
    <span class="daifuk-series-navigation__title">シリーズを続けて読む</span>
  </div>
  <?php if ( $neighbors['previous'] || $neighbors['next'] ) : ?>
    <div class="daifuk-series-navigation__links">
      <?php if ( $neighbors['previous'] ) : ?>
        <a class="daifuk-series-navigation__link daifuk-series-navigation__link--previous" href="<?php echo esc_url( get_permalink( $neighbors['previous'] ) ); ?>">
          <span class="daifuk-series-navigation__direction">← 前の記事</span>
          <span class="daifuk-series-navigation__post-title"><?php echo esc_html( get_the_title( $neighbors['previous'] ) ); ?></span>
        </a>
      <?php endif; ?>
      <?php if ( $neighbors['next'] ) : ?>
        <a class="daifuk-series-navigation__link daifuk-series-navigation__link--next" href="<?php echo esc_url( get_permalink( $neighbors['next'] ) ); ?>">
          <span class="daifuk-series-navigation__direction">次の記事 →</span>
          <span class="daifuk-series-navigation__post-title"><?php echo esc_html( get_the_title( $neighbors['next'] ) ); ?></span>
        </a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <a class="daifuk-series-navigation__archive-link" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $series['name'] ); ?>一覧を見る</a>
</nav>
