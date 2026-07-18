<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// 対象シリーズは、投稿日順のCocoon標準ナビを出力しない。
if ( daifuk_get_post_series() ) return;

require get_template_directory() . '/tmp/pager-post-navi.php';
