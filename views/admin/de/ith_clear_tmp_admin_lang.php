<?php
$sLangName = 'Deutsch';
$aLang     = [
    'charset'                => 'UTF-8',
    'ITH_MODULES'            => 'ITholics Module',
    'MAIN'                   => 'Haupt',
    'ITH_CLEAR_TMP'          => '<div style="display: flex; align-items: center;"><img src="../modules/ith_modules/ith_clear_tmp/out/thumb_white.png" alt="" title="ITholics" style="height: 15px; margin-right: 5px;" /> <span>TMP Löschen</span></div>',
    'ITH_CLEAR_TMP2'         => 'TMP Löschen',
    'VERBOSE'                => 'Verbose',
    'CLEAR'                  => 'Säubern',
    'SHOP_MODULE_blHotkey'   => 'Hotkey zum Löschen inPage nutzen<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<code>STRG + SHIFT + ENTF</code> in OSX<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<code>STRG + SHIFT + ALT + ENTF</code> in Windows/Linux',
    'SHOP_MODULE_aIpList'    => 'IP-Ausnahmen für Hotkeybenutzung.<br>Wenn leer, dann sind alle IPs gültig.<br>Ihre IP: <strong>' . (class_exists('ith_clear_tmp_conf') ? ith_clear_tmp_conf::getClientIp() : 'n.v.') . '</strong>',
    'SHOP_MODULE_blPHP'      => 'Benutze PHP statt Linux-Befehle.',
    'SHOP_MODULE_GROUP_main' => 'In-Page-Einstellungen',
];
