<?php

namespace ITholics\ClearTemplate\controllers\admin;
use ITholics\ClearTemplate\core\ith_clear_tmp_conf;
use OxidEsales\Eshop\Application\Controller\Admin\AdminController;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

/**
 * Class ith_clear_tmp_admin<br>
 * <br>
 * Hanndling deletion of template data.
 *
 */
class ith_clear_tmp_admin extends AdminController
{
	protected $_sThisTemplate = 'ith_clear_tmp_admin.tpl';
	protected $_sThisAjaxTemplate = 'ith_clear_tmp.tpl';
	/**
	 * @var bool if true, returning 'non-html'
	 */
	protected $_blAjax = false;
	
	public function init()
	{
		parent::init();
		// expection some ajax param for ajax requests
		$this->_blAjax = (bool)Registry::get(Request::class)->getRequestEscapedParameter('ajax');
	}
	
	public function render()
	{
		parent::render();
		if ($this->_blAjax) {
			// now run the clearance...
			$aResult = ith_clear_tmp_conf::_()->clearCache();
			$sAppend = "\nDeleted:\n" . print_r($aResult['success'], true) . "\n\nFailed:\n" . print_r($aResult['errors'], true);
			if (empty($aResult['success'])) {
				return $this->_result('Failed to delete' . $sAppend, 666);
			}
			return $this->_result('Cleared TMP' . $sAppend);
		}
		return $this->_sThisTemplate;
	}
	
	/**
	 * Clear template data
	 */
	public function clear()
	{
		$aResult = ith_clear_tmp_conf::_()->clearCache();
		$aResult['tmp-folder'] = ith_clear_tmp_conf::_()->getTempDir();
		echo '<pre>', print_r($aResult, true), '</pre>';
	}
	
	/**
	 * Updating result for response
	 *
	 * @param string $sReason
	 * @param int    $iCode
	 *
	 * @return string
	 */
	protected function _result($sReason, $iCode = 200)
	{
		http_response_code($iCode);
		$this->_aViewData['failed'] = $sReason;
		return $this->_sThisAjaxTemplate;
	}
}
