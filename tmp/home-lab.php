<?php
if ( !defined( 'ABSPATH' ) ) exit;

// 最も大きな連載番号を動的に取得する処理は、共通シリーズテンプレートの総記事数表示へ置き換える。
// Cocoon標準のエントリーカードテンプレートは、共通シリーズテンプレートから安全に読み込む。
get_template_part( 'tmp/home-series', null, array(
    'slug'        => 'ai-lab',
    'section_id'  => 'lab',
    'section_num' => '03 / MAIN_SERIES',
    'title'       => 'AI実験ノート',
    'description' => 'AIを実際の仕事で使用したプロセス、成功と失敗の完全な実験記録。',
    'tone'        => 'gray',
) );
