<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function daifuk_get_series_configs() {
    return array(
        'ai-lab' => array( 'name' => 'AI実験ノート', 'description' => 'AIを実際の仕事で試し、成功と失敗を記録する実験ノートです。' ),
        'ai-work' => array( 'name' => 'AIと働く', 'description' => 'AIと働く日々の気づきと、これからの仕事のあり方を考える連載です。' ),
        'design-ai' => array( 'name' => 'デザインとAI', 'description' => 'デザインの現場でAIと向き合い、よりよい対話と制作を探る連載です。' ),
    );
}

function daifuk_get_series_config_by_category( $category ) {
    $configs = daifuk_get_series_configs();
    $slug = is_object( $category ) ? $category->slug : sanitize_title( $category );
    return isset( $configs[ $slug ] ) ? $configs[ $slug ] + array( 'slug' => $slug ) : null;
}

function daifuk_get_post_series( $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    if ( ! $post_id || 'post' !== get_post_type( $post_id ) ) return null;
    foreach ( daifuk_get_series_configs() as $slug => $config ) {
        if ( has_category( $slug, $post_id ) ) return $config + array( 'slug' => $slug );
    }
    return null;
}

function daifuk_get_series_number( $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    if ( ! $post_id || ! daifuk_get_post_series( $post_id ) ) return null;
    foreach ( array( 'series_number', 'experiment_number' ) as $meta_key ) {
        $value = get_post_meta( $post_id, $meta_key, true );
        if ( is_numeric( $value ) && (int) $value > 0 ) return (int) $value;
    }
    $slug = get_post_field( 'post_name', $post_id );
    if ( preg_match( '/(?:^|[-_])(?:vol[-_]?)?0*([0-9]+)(?:[-_]|$)/i', $slug, $matches ) ) return (int) $matches[1];
    $title = html_entity_decode( get_the_title( $post_id ), ENT_QUOTES, 'UTF-8' );
    if ( preg_match( '/(?:#\s*|Vol\.?\s*)([0-9]+)/iu', $title, $matches ) ) return (int) $matches[1];
    return null;
}

function daifuk_get_series_number_label( $post_id = 0 ) {
    $number = daifuk_get_series_number( $post_id );
    return null === $number ? '' : sprintf( 'Vol.%02d', $number );
}

function daifuk_get_series_post_ids( $series_slug ) {
    $cache_key = 'daifuk_series_ids_' . sanitize_key( $series_slug );
    $cached = get_transient( $cache_key );
    if ( false !== $cached ) return $cached;
    $term = get_category_by_slug( $series_slug );
    if ( ! $term ) return array();
    $query = new WP_Query( array( 'post_type' => 'post', 'post_status' => 'publish', 'cat' => $term->term_id, 'posts_per_page' => -1, 'fields' => 'ids', 'ignore_sticky_posts' => true, 'no_found_rows' => true, 'update_post_meta_cache' => false, 'update_post_term_cache' => false ) );
    $ids = array_filter( $query->posts, function( $post_id ) { return null !== daifuk_get_series_number( $post_id ); } );
    usort( $ids, function( $left, $right ) {
        $left_number = daifuk_get_series_number( $left );
        $right_number = daifuk_get_series_number( $right );
        return $left_number === $right_number ? $left <=> $right : $left_number <=> $right_number;
    } );
    $ids = array_values( $ids );
    set_transient( $cache_key, $ids, DAY_IN_SECONDS );
    return $ids;
}

function daifuk_clear_series_post_cache( $post_id ) {
    if ( ! daifuk_get_post_series( $post_id ) ) return;
    foreach ( array_keys( daifuk_get_series_configs() ) as $slug ) delete_transient( 'daifuk_series_ids_' . $slug );
}
add_action( 'save_post', 'daifuk_clear_series_post_cache' );
add_action( 'deleted_post', 'daifuk_clear_series_post_cache' );
