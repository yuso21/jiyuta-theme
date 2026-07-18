<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function daifuk_order_series_category_archive( $query ) {
    if ( is_admin() || ! $query->is_main_query() || ! $query->is_category() ) return;
    $series = daifuk_get_series_config_by_category( $query->get_queried_object() );
    if ( ! $series ) return;
    $ids = daifuk_get_series_post_ids( $series['slug'] );
    $query->set( 'post__in', $ids ? $ids : array( 0 ) );
    $query->set( 'orderby', 'post__in' );
    $query->set( 'ignore_sticky_posts', true );
}
add_action( 'pre_get_posts', 'daifuk_order_series_category_archive' );

function daifuk_render_series_category_description( $content ) {
    if ( ! is_category() ) return $content;
    $series = daifuk_get_series_config_by_category( get_queried_object() );
    if ( ! $series ) return $content;
    $description = trim( wp_strip_all_tags( $content ) );
    if ( '' === $description ) $description = $series['description'];
    return '<p class="daifuk-series-archive-description">' . esc_html( $description ) . '</p>';
}
add_filter( 'the_category_content', 'daifuk_render_series_category_description' );

function daifuk_render_series_card_number( $post_id ) {
    if ( ! is_category() || ! daifuk_get_post_series( $post_id ) ) return;
    $label = daifuk_get_series_number_label( $post_id );
    if ( $label ) echo '<span class="daifuk-series-card-number">' . esc_html( $label ) . '</span>';
}
add_action( 'entry_card_snippet_after', 'daifuk_render_series_card_number', 11 );
