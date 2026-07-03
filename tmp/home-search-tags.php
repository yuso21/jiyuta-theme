<?php if ( !defined( 'ABSPATH' ) ) exit; ?>
<section id="search-tags-nav" class="daifuk-section-white">
  <div class="daifuk-nav-container">
    
    <!-- ⑦ 検索フォーム -->
    <div class="daifuk-search-block">
      <span class="section-num" style="text-align: center; margin-bottom: 12px; display: block;">SEARCH</span>
      <h3 class="daifuk-nav-sub-title">サイト内検索</h3>
      <div class="daifuk-search-form-wrap">
        <?php get_search_form(); ?>
      </div>
    </div>

    <!-- ⑧ カテゴリー一覧（横並び） -->
    <div class="daifuk-categories-block">
      <h3 class="daifuk-nav-sub-title">カテゴリー</h3>
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

    <!-- ⑨ タグクラウド（横並び） -->
    <div class="daifuk-tags-block">
      <h3 class="daifuk-nav-sub-title">人気のタグ</h3>
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
</section>
