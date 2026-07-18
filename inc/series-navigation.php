<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function daifuk_get_series_neighbors( $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $series = daifuk_get_post_series( $post_id );
    if ( ! $series ) return array( 'previous' => null, 'next' => null );
    $ids = daifuk_get_series_post_ids( $series['slug'] );
    $position = array_search( $post_id, $ids, true );
    if ( false === $position ) return array( 'previous' => null, 'next' => null );
    return array( 'previous' => $position > 0 ? $ids[ $position - 1 ] : null, 'next' => isset( $ids[ $position + 1 ] ) ? $ids[ $position + 1 ] : null );
}

function daifuk_render_series_post_navigation() {
    if ( ! is_single() || ! daifuk_get_post_series() ) return;
    get_template_part( 'tmp/series-post-navigation' );
}
add_action( 'singular_entry_content_after', 'daifuk_render_series_post_navigation', 20 );

function daifuk_enqueue_series_navigation_styles() {
    $is_series_single = is_single() && daifuk_get_post_series();
    $is_series_archive = is_category() && daifuk_get_series_config_by_category( get_queried_object() );
    if ( ! $is_series_single && ! $is_series_archive ) return;
    wp_enqueue_style( 'daifuk-series-navigation', get_stylesheet_directory_uri() . '/css/series-navigation.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'daifuk_enqueue_series_navigation_styles' );
