<?php

namespace DarkHelmet\Core;

require_once(PROJECT_DIR.'tests/TestCase.php');

/**
 * Test class for Request.
 * Generated by PHPUnit on 2012-05-14 at 21:58:56.
 */
class RequestTest extends \TestCase {

	/**
	 * @var Request
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Request;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}
	
	/**
	 * @test
	 * @covers \DarkHelmet\Core\Request::getPostFields
	 */
	public function getPostFields_ReturnsEmptyArray_WhenPostFieldsNotSet() {
		$this->assertSame(array(), $this->object->getPostFields());
	}
	
	/**
	 * @test
	 * @covers \DarkHelmet\Core\Request::getPostFields
	 * @covers \DarkHelmet\Core\Request::setPostFields
	 */
	public function getPostField_ReturnsArray_AfterArrayWasSet() {
		$array = array('foo', 'bar', 'baz');
		$this->object->setPostFields($array);
		$this->assertSame($array, $this->object->getPostFields());
	}
	
	/**
	 * @test
	 * @covers \DarkHelmet\Core\Request::getUrl
	 */
	public function getUrl_ReturnsEmptyString_WhenNoUrlSet() {
		$this->assertSame('', $this->object->getUrl());
	}
	
	/**
	 * @test
	 * @covers \DarkHelmet\Core\Request::getUrl
	 * @covers \DarkHelmet\Core\Request::setUrl
	 */
	public function getUrl_ReturnsPreviouslySetValue_AfterValueIsSet() {
		$sUrl = '/foo/bar/baz';
		$this->object->setUrl($sUrl);
		$this->assertSame($sUrl, $this->object->getUrl());
	}

    /**
     * @test
     * @dataProvider dataProviderOfExampleBaseUrls
     *
     * @param $p_sBaseUrl
     */
	public function getParamsFor_ReturnsArrayOfParts_WhenStringGiven($p_sBaseUrl) {
		$sInput = '/foo/bar/baz/biz/boz';
		$aExpected = array('baz', 'biz', 'boz');

        $this->object->setUrl($sInput);

		$this->assertSame($aExpected, $this->object->getParamsFor($p_sBaseUrl));
    }

    /**
     * @test
     * @dataProvider dataProviderOfExampleBaseUrls
     *
     * @param $p_sBaseUrl
     */
	public function getParamsFor_ReturnsArrayWithoutEmptyParts_WhenStringWithEmptyPartsGiven($p_sBaseUrl) {
        $sInput = '/foo/bar/baz//biz//boz';
        $aExpected = array('baz', 'biz', 'boz');

        $this->object->setUrl($sInput);

        $this->assertSame($aExpected, $this->object->getParamsFor($p_sBaseUrl));
	}
	
	/**
	 * @test
	 * @covers \DarkHelmet\Core\Request::get
	 */
	public function get_ReturnsRequestWithUrlAndParams_WhenCalled() {
		$sUrl = '/lorem/ipsum/dolor/sit/amet';
		$aParams = array('foo', 'bar', 'baz');
		$oResult = Request::get($sUrl, $aParams);
		
		$this->assertInstanceOf('\\DarkHelmet\\Core\\Request', $oResult);
		$this->assertSame($sUrl, $oResult->getUrl());
		$this->assertSame($aParams, $oResult->getPostFields());
	}
	
	/**
	 * @test
	 * 
	 * @covers \DarkHelmet\Core\Request::__toString
	 */
	public function __toString_ReturnsEmptyString_WhenNoUrlIsSet() {
		$this->assertSame('', $this->object->__toString());
	}
	
	/**
	 * @test
	 * 
	 * @covers \DarkHelmet\Core\Request::__toString
	 */
	public function __toString_ReturnsStringWithUrl_WhenUrlIsSet() {
		$sUrl = '/foo/bar/baz';
		$this->object->setUrl($sUrl);
		$this->assertSame($sUrl, $this->object->__toString());
	}

    public function dataProviderOfExampleBaseUrls()
    {
        return array(
            array('/foo/bar')
        , array('/foo/bar/')
        , array('foo/bar/')
        , array('foo/bar')
        );
    }


}

?>
