<?php
/**
 * Author: Tomas Domanik
 */

namespace HausO\Img2text;

class Img2textTest extends \PHPUnit_Framework_TestCase
{
    protected $_stub;
    protected $_inst;
    protected $_width = 5;
    protected $_height = 1;

    public function __construct()
    {
        $this->resource();

        $this->_inst = new Img2text($this->_stub);
    }


    public function resource()
    {
        $im = imagecreate($this->_width, $this->_height);

        $white = imagecolorallocate($im, 255, 255, 255);
        $red = imagecolorallocate($im, 255, 0, 0);
        $rnd = imagecolorallocate($im, 110, 24, 234);

        imagesetpixel($im, 1, 0, $white);
        imagesetpixel($im, 2, 0, $red);
        imagesetpixel($im, 3, 0, $rnd);

        $this->_stub = $this->getMockForAbstractClass('HausO\Img2text\Img2text\Img2text_Abstract');
        $this->_stub->setResource($im);
    }

    public function testGetScaleDefault()
    {
        $this->assertEquals($this->_inst->getScale(), 1);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Scale must be greather equal or than 1!
     */
    public function testSetScaleExceptionForBelowOne()
    {
        $this->_inst->setScale(0.5);
        $this->getExpectedException();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Scale must be greather equal or than 1!
     */
    public function testSetScaleExceptionForString()
    {
        $this->_inst->setScale('not_a_number');
        $this->getExpectedException();
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to HausO\Img2text\Img2text::setSource() must be an instance of HausO\Img2text\Img2text\Img2text_Abstract, boolean given
     */
    public function testSetSourceWrongType()
    {
        $this->_inst->setSource(false);
    }



}
