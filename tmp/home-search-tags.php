<?php if ( !defined( 'ABSPATH' ) ) exit; ?>
<section id="search-tags-nav" class="daifuk-section-white">
  <div class="daifuk-section-inner">
    <div class="daifuk-nav-container">
      
      <!-- ⑦ 検索フォーム -->
      <div class="daifuk-search-block">
        <span class="section-num" style="margin-bottom: 8px; display: block;">07 / FIND_LOGS</span>
        <h3 class="daifuk-nav-sub-title">Search</h3>
        <div class="daifuk-search-form-wrap">
          <?php get_search_form(); ?>
        </div>
      </div>

      <!-- ⑧ カテゴリー一覧 -->
      <div class="daifuk-categories-block">
        <span class="section-num" style="margin-bottom: 8px; display: block;">08 / DIRECTORY</span>
        <h3 class="daifuk-nav-sub-title">Categories</h3>
        <div class="daifuk-nav-list">
          <?php
          $categories = get_categories( array(
              'orderby' => 'name',
              'order'   => 'ASC',
              'hide_empty' => 1
          ) );
          foreach ( $categories as $category ) {
              echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
          }
          ?>
        </div>
      </div>

      <!-- ⑨ タグクラウド -->
      <div class="daifuk-tags-block">
        <span class="section-num" style="margin-bottom: 8px; display: block;">09 / TOPICS</span>
        <h3 class="daifuk-nav-sub-title">Tags</h3>
        <div class="daifuk-nav-tags">
          <?php
          $tags = get_tags( array(
              'orderby' => 'count',
              'order'   => 'DESC',
              'number'  => 15
          ) );
          if ( !empty( $tags ) ) {
              foreach ( $tags as $tag ) {
                  echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">#' . esc_html( $tag->name ) . '</a>';
              }
          }
          ?>
        </div>
      </div>

    </div>
  </div>
</section>
