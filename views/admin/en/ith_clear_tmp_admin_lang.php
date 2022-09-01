<?php
$sLangName = 'English';
$aLang     = [
    'charset'                => 'UTF-8',
    'ITH_MODULES'            => 'ITholics Module',
    'MAIN'                   => 'Main',
    'ITH_CLEAR_TMP'          => '<div style="display: flex; align-items: center;"><img src="../modules/ith_modules/ith_clear_tmp/out/thumb_white.png" alt="" title="ITholics" style="height: 15px; margin-right: 5px;" /> <span>Clear TMP</span></div>',
    'ITH_CLEAR_TMP2'         => 'Clear TMP',
    'VERBOSE'                => 'Verbose',
    'CLEAR'                  => 'Clear',
    'SHOP_MODULE_blHotkey'   => 'Use hotkey in-page to delete<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<code>CTRL + SHIFT + DEL</code> in OSX<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<code>CTRL + SHIFT + ALT + DEL</code> in Windows/Linux',
    'SHOP_MODULE_aIpList'    => 'IP whitelist for in-page hotkey usage.<br>If empty, all IPs are valid.<br>Your IP: <strong>' . (class_exists('ith_clear_tmp_conf') ? ith_clear_tmp_conf::getClientIp() : 'n.v.') . '</strong>',
    'SHOP_MODULE_blPHP'      => 'Use PHP instead of Linux commands.',
    'SHOP_MODULE_GROUP_main' => 'In-page settings',
];


