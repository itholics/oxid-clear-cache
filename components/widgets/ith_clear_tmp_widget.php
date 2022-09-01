<?php

namespace ITholics\ClearTemplate\components\widgets;

use ITholics\ClearTemplate\core\ith_clear_tmp_conf;
use OxidEsales\Eshop\Application\Component\Widget\WidgetController;
use OxidEsales\Eshop\Core\Registry;

/**
 * Class ith_clear_tmp_widget
 * Widget for handling hotkey mechanism on page itself
 */
class ith_clear_tmp_widget extends WidgetController
{
    /** @var string template to use */
    protected $_sThisTemplate = 'ith_clear_tmp_widget.tpl';
    /** @var bool hotkey enabled? */
    protected $_blHotkey = false;
    
    public function render()
    {
        parent::render();
        // Hotkey is enabled if itself is enabled and IP is white listed
        $this->_aViewData['blHotkey'] = $this->_blHotkey = (Registry::getConfig()->getConfigParam('blHotkey') && ith_clear_tmp_conf::_()->isWhiteListed());
        return $this->_sThisTemplate;
    }
}