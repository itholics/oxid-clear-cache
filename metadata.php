<?php
use ITholics\ClearTemplate\components\widgets\ith_clear_tmp_widget;
use ITholics\ClearTemplate\controllers\admin\ith_clear_tmp_admin;
use ITholics\ClearTemplate\controllers\ith_clear_tmp;
use ITholics\ClearTemplate\core\ith_clear_tmp_conf;

/**
 * Metadata version definition
 */
$sMetadataVersion = '2.1';
/**
 *
 */
$aModule = [
    'id'          => 'ith_clear_tmp',
    'title'       => [
        'de' => '<div style="display:flex; align-items: center;"><img src="../modules/ith_modules/ith_clear_tmp/out/thumb.png" alt="ith" title="ITholics" style="height: 15px; margin-right: 5px;" /> <span><strong>IT</strong>holics - Temporäre Dateien löschen - OXID.v6</span></div>',
        'en' => '<div style="display:flex; align-items: center;"><img src="../modules/ith_modules/ith_clear_tmp/out/thumb.png" alt="ith" title="ITholics" style="height: 15px; margin-right: 5px;" /> <span><strong>IT</strong>holics - Clear temporary files - OXID.v6</span></div>'
    ],
    'description' => [
        'de' => 'Löscht die Inhalte des /tmp Verzeichnisses.',
        'en' => 'Deletes the contents of the /tmp folder.'
    ],
    'thumbnail'   => 'out/logo.png',
    'version'     => '6.3.3',
    'author'      => 'ITholics GmbH',
    'url'         => 'https://itholics.de',
    'email'       => 'info@itholics.de',
    'controllers' => [
        // Controllers for Admin
        'ith_clear_tmp_admin'  => ith_clear_tmp_admin::class,
        'ith_clear_tmp_widget' => ith_clear_tmp_widget::class,
        'ith_clear_tmp'        => ith_clear_tmp::class,
        'ith_clear_tmp_conf'   => ith_clear_tmp_conf::class,
    ],
    'templates'   => [
        // Admin
        'ith_clear_tmp_admin.tpl'  => 'ith_modules/ith_clear_tmp/views/admin/tpl/ith_clear_tmp_admin.tpl',
        'ith_clear_tmp_widget.tpl' => 'ith_modules/ith_clear_tmp/views/tpl/widget/ith_clear_tmp_widget.tpl',
        'ith_clear_tmp.tpl'        => 'ith_modules/ith_clear_tmp/views/tpl/page/ith_clear_tmp.tpl',
    ],
    'extend'      => [],
    'blocks'      => [
        [
            'template' => 'layout/footer.tpl',
            'block'    => 'footer_main',
            'file'     => 'views/blocks/layout/ith_clear_tmp_block.tpl'
        ],
        [
            'template' => 'header.tpl',
            'block'    => 'admin_header_links',
            'file'     => 'views/blocks/admin/ith_clear_tmp_header.tpl'
        ],
        [
            'template' => 'include/header_links.tpl',
            'block'    => 'admin_header_links',
            'file'     => 'views/blocks/admin/ith_clear_tmp_header.tpl'
        ]
    ],
    'events'      => [],
    'settings'    => [
        ['group' => 'main', 'name' => 'blHotkey', 'type' => 'bool', 'value' => true],
        ['group' => 'main', 'name' => 'aIpList', 'type' => 'arr'],
        ['group' => 'main', 'name' => 'blPHP', 'type' => 'bool', 'value' => true]
    ]
];
