<?php

namespace ITholics\ClearTemplate\core;

use OxidEsales\Eshop\Core\Registry;
use function rtrim;
use const DIRECTORY_SEPARATOR;

class ith_clear_tmp_conf
{
    /** @var ith_clear_tmp_conf */
    protected static $_instance;
    /** @var string */
    protected $sShopDir = '/';
    /** @var string */
    protected $sCompileDir = '/tmp';
    
    /**
     * ith_clear_tmp_conf constructor.
     * Private: use factory method
     * @see ith_clear_tmp_conf::_()
     */
    public function __construct()
    {
        include getShopBasePath() . 'config.inc.php';
        //adding trailing slashes
        $oFileUtils        = Registry::getUtilsFile();
        $this->sShopDir    = $oFileUtils->normalizeDir($this->sShopDir);
        $this->sCompileDir = $oFileUtils->normalizeDir($this->sCompileDir);
    }
    
    /**
     * @return string shop directory
     */
    public function getShopDir()
    {
        return $this->sShopDir;
    }
    
    /**
     * @return string temp directory
     */
    public function getTempDir()
    {
        return $this->sCompileDir;
    }
    
    /**
     * Factory function
     * @return ith_clear_tmp_conf
     */
    public static function _()
    {
        if (!self::$_instance) {
            self::$_instance = oxNew(static::class);
        }
        return self::$_instance;
    }
    
    public function isReload()
    {
        return Registry::getConfig()->getConfigParam('blReload');
    }
    
    /**
     * @return array of strings / IPs
     */
    public function getWhitelist()
    {
        return Registry::getConfig()->getConfigParam('aIpList');
    }
    
    public function isIP($ip)
    {
        if (!is_string($ip)) {
            return false;
        }
        return (bool)preg_match('/^\s*\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\s*$/', $ip);
    }
    
    /**
     * @return bool true if IP is allowed or empty
     */
    public function isWhiteListed()
    {
        $aList = $this->getWhitelist();
        if (!empty($aList)) {
            $aList2 = [];
            foreach ($aList as $index => $item) {
                if ($this->isIP($item)) {
                    $aList2[] = trim($item);
                }
            }
            if (!($userIp = $this->getClientIp())) {
                return false;
            }
            if (!empty($aList2)) {
                return in_array($userIp, $aList2, true);
            }
        }
        return true;
    }
    
    /**
     * @return string client IP
     */
    public function getClientIp()
    {
        $ipaddress = null;
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        }
        return $ipaddress;
    }
    
    /**
     * Action of deleting contents of tmp folder except hidden files (starting with '.' (point).<br>
     * Using unlink for tmp files and 'rm' command for tmp/starty/<br>
     *
     * @return array['errors' => [string], 'success' => [string]]
     */
    public function clearCache()
    {
        error_reporting(0);
        $sDir    = $this->getTempDir();
        $aErrors = [];
        $aDelete = [];
        $config  = Registry::getConfig();
        $blPHP   = $config->getConfigParam('blPHP');
        if ($blPHP) {
            $sDir = rtrim($sDir, " \t\n\r\0\x0B" . '\\' . DIRECTORY_SEPARATOR);
            $tpl  = glob("$sDir/smarty/*");
            $data = array_filter(glob("$sDir/*"), 'is_file');
            foreach ($tpl as $path) {
                if (unlink($path)) {
                    $aDelete[] = $path;
                } else {
                    $aErrors[] = $path;
                }
            }
            foreach ($data as $path) {
                if (unlink($path)) {
                    $aDelete[] = $path;
                } else {
                    $aErrors[] = $path;
                }
            }
        } else {
            foreach (scandir($sDir) as $sFile) {
                $sComplete = $sDir . $sFile;
                if ($sFile[0] !== '.' && !is_dir($sComplete)) {
                    if (!unlink($sComplete)) {
                        $aErrors[] = $sFile;
                    } else {
                        $aDelete[] = $sFile;
                    }
                }
                exec("rm -fv {$sDir}smarty/*", $aDelete, $iResult);
            }
        }
        return [
            'errors'  => $aErrors,
            'success' => $aDelete
        ];
    }
    
    /**
     * Dump to log file, for debugging purpose
     *
     * @param mixed $mMessage [, $mMessage2 ...]
     */
    public static function dump($mMessage)
    {
        foreach (func_get_args() as $arg) {
            Registry::getLogger()->debug(print_r($arg, true));
        }
    }
}