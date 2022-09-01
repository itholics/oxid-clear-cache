<?php
use ITholics\ClearTemplate\core\ith_clear_tmp_conf;

class ith_clear_tmp_confTest extends oxUnitTestCase
{
    /** @var  oxConfig */
    protected $_oConfig;
    /** @var  ith_clear_tmp_conf */
    protected $_oTmp;
    
    public function setUp()
    {
        parent::setUp();
        $this->_oConfig = oxRegistry::getConfig();
        $this->_oTmp    = ith_clear_tmp_conf::_();
    }
    
    public function ipProvider()
    {
        return [
            'zeros'               => ['0.0.0.0', true],
            'maximum'             => ['999.999.999.999', true],
            'localhost-ip'        => ['127.0.0.1', true],
            'friz.box'            => ['192.168.178.1', true],
            '10.0.0.10'           => ['10.0.0.10', true],
            '3 parts'             => ['123.123.123', false],
            'localhost-string'    => ['localhost', false],
            '5 parts'             => ['1.2.3.4.5', false],
            'with port'           => ['123.123.123.123:80', false],
            '4 digits'            => ['123.123.123.1234', false],
            'a number'            => [231, false],
            'a float'             => [123.123, false],
            'an array of numbers' => [[123, 123, 123, 123], false],
            'boolean true'        => [true, false],
            'boolean false'       => [false, false]
        ];
    }
    
    /**
     *
     */
    public function testClassLoadedCorrectly()
    {
        $this->assertInstanceOf('oxConfig', $this->_oConfig);
        $this->assertInstanceOf('ith_clear_tmp_conf', $this->_oTmp);
        $this->assertNotNull($this->_oTmp->getTempDir(), 'Cache/tmp directory not found');
        $this->assertNotNull($this->_oTmp->getShopDir(), 'Shop directory not found');
    }
    
    /**
     * @param $mIp
     * @param $blCorrectIP
     *
     * @dataProvider ipProvider
     */
    public function testIsIp($mIp, $blCorrectIP)
    {
        $this->assertEquals($blCorrectIP, $this->_oTmp->isIP($mIp));
    }
    
    /**
     *
     */
    public function testWhiteList()
    {
        $this->assertEmpty($this->_oTmp->getWhitelist());
        $aWhiteList = ['123.123.123.213'];
        $this->_oConfig->setConfigParam('aIpList', $aWhiteList);
        $this->assertCount(1, $this->_oTmp->getWhitelist());
        $this->assertEquals('123.123.123.213', $this->_oTmp->getWhitelist()[0]);
        $this->_oConfig->setConfigParam('aIpList', []);
        $this->assertEmpty($this->_oTmp->getWhitelist());
    }
    
    public function testIsWhiteListed()
    {
        $oMock = $this->getMock('ith_clear_tmp_conf', ['getClientIp', 'getWhitelist']);
        $oMock->method('getClientIp')->willReturn('123.123.123.123');
        $oMock->method('getWhitelist')->will($this->onConsecutiveCalls(
            [], ['127.0.0.1'], ['localhost'], ['123.123.123.123'],
            ['localhost', '1.2.3.4'], ['localhost', '1.2.3.4', '123.123.123.123']
        ));
        $this->assertTrue($oMock->isWhiteListed(), 'Empty array');
        $this->assertFalse($oMock->isWhiteListed(), 'localhost ip');
        $this->assertTrue($oMock->isWhiteListed(), 'localhost-string');
        $this->assertTrue($oMock->isWhiteListed(), 'correct single ip');
        $this->assertFalse($oMock->isWhiteListed(), 'false multiple entries');
        $this->assertTrue($oMock->isWhiteListed(), 'correct multiple entries');
    }
}