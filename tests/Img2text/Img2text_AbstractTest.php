<?php
/**
 * Author: Tomas Domanik
 */

namespace HausO\Img2text\Img2text;

class Img2text_AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected $_stub;
    protected $_stubFalse;
    protected $_width = 5;
    protected $_height = 1;

    public function __construct()
    {
        $this->_stubFalse = $this->getMockForAbstractClass('HausO\Img2text\Img2text\Img2text_Abstract');

        $this->_stub = $this->getMockForAbstractClass('HausO\Img2text\Img2text\Img2text_Abstract');

        $this->createImage();
    }


    public function createImage()
    {
        $im = imagecreate($this->_width, $this->_height);

        $white = imagecolorallocate($im, 255, 255, 255);
        $red = imagecolorallocate($im, 255, 0, 0);
        $rnd = imagecolorallocate($im, 110, 24, 234);

        imagesetpixel($im, 1, 0, $white);
        imagesetpixel($im, 2, 0, $red);
        imagesetpixel($im, 3, 0, $rnd);

        $this->_stub->setResource($im);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Resource must be Image(gd), "boolean" given
     */
    public function testSetResourceExceptionForNonResource()
    {
        $this->_stub->setResource(false);
        $this->getExpectedException();
    }


    /**
     * @expectedException Exception
     * @expectedExceptionMessage Resource must be Image(gd), "xml" given
     */
    public function testSetResourceExceptionForNonGD()
    {
        $resource = xml_parser_create();
        $this->_stub->setResource($resource);
        $this->getExpectedException();
    }

    public function testGetWidth()
    {
        $this->assertEquals($this->_stub->getWidth(), $this->_width);
    }

    public function testGetHeight()
    {
        $this->assertEquals($this->_stub->getHeight(), $this->_height);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Width Ratio must be numeric, "two" is string
     */
    public function testGetWidthRatioException()
    {
        $this->_stub->setWidthRatio('two');
        $this->getExpectedException();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Height Ratio must be numeric, "two" is string
     */
    public function testGetHeightRatioException()
    {
        $this->_stub->setHeightRatio('two');
        $this->getExpectedException();
    }

    public function testGetSaturation()
    {
        $color = imagecolorat($this->_stub->getResource(), 0, 0);
        $saturation = $this->_stub->getSaturation($color);
        $this->assertEquals(1, $saturation);
    }

    public function testGetSaturation2()
    {
        $color = imagecolorat($this->_stub->getResource(), 1, 0);
        $saturation = $this->_stub->getSaturation($color);
        $this->assertEquals(1, $saturation);
    }

    public function testGetSaturation3()
    {
        $color = imagecolorat($this->_stub->getResource(), 2, 0);
        $saturation = $this->_stub->getSaturation($color);
        $this->assertEquals(0.33, round($saturation, 2));
    }

    public function testGetSaturation4()
    {
        $color = imagecolorat($this->_stub->getResource(), 3, 0);
        $saturation = $this->_stub->getSaturation($color);
        $this->assertEquals(0.48, round($saturation, 2));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Resource Image not set
     */
    public function testGetSaturationException()
    {
        $color = imagecolorat($this->_stub->getResource(), 0, 0);
        $this->_stubFalse->getSaturation($color);
        $this->getExpectedException();
    }


    /**
     * @expectedException Exception
     * @expectedExceptionMessage Resource Image not set
     */
    public function testGetWidthException()
    {
        $this->_stubFalse->getWidth();
        $this->getExpectedException();
    }


    /**
     * @expectedException Exception
     * @expectedExceptionMessage Resource Image not set
     */
    public function testGetHeightException()
    {
        $this->_stubFalse->getWidth();
        $this->getExpectedException();
    }


}

