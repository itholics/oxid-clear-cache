<?php

namespace ITholics\ClearTemplate\controllers;

use ITholics\ClearTemplate\core\ith_clear_tmp_conf;
use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Registry;

/**
 * Class ith_clear_tmp<br>
 * <br>
 * This class is used by ajax request<br>
 *  - First for in-page requests
 *  - Second for admin header button as ajax request
 */
class ith_clear_tmp extends FrontendController
{
    /** @var string template to use, should be empty, only containing possible error message */
    protected $_sThisTemplate = 'ith_clear_tmp.tpl';
    
    public function render()
    {
        parent::render();
        // hotkey enabled ?
        $config = Registry::getConfig();
        if (!$config->getConfigParam('blHotkey')) {
            $this->_result('Not activated', 409);
            return $this->_sThisTemplate;
        }
        // IP on whitelist?
        if (!ith_clear_tmp_conf::_()->isWhiteListed()) {
            $this->_result('Not whitelisted', 409);
            return $this->_sThisTemplate;
        }
        // now run the clearance...
        $aResult = ith_clear_tmp_conf::_()->clearCache();
        if (empty($aResult['success'])) {
            $this->_result('Failed to delete', 666);
        } else {
            $this->_result('Cleared TMP');
        }
        return $this->_sThisTemplate;
    }
    
    /**
     * Updaeting result for response
     *
     * @param string $sReason
     * @param int    $iCode
     */
    protected function _result($sReason, $iCode = 200)
    {
        http_response_code($iCode);
        $this->_aViewData['failed'] = $sReason;
    }
}