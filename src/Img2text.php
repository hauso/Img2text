<?php

/**
 * Author: Tomas Domanik
 */
namespace HausO\Img2text;

use HausO\Img2text\Img2text\Img2text_Abstract AS ResourceAbstract;

class Img2text
{

    protected $_imageResource;
    protected $_scale = 1;
    protected $_chars = "%XHI#+:.";
    protected $_width = null;
    protected $_height = null;

    const EXCEPTION_MESSAGE_SOURCE = 'Source not defined';
    const EXCEPTION_MESSAGE_SCALE = 'Scale must be greather equal or than 1!';

    public function __construct(ResourceAbstract $imageResource)
    {
        $this->setSource($imageResource);
    }

    public function draw()
    {
        $this->getSource();

        $chars = $this->getChars();

        $steps = count(preg_split('//', $chars, -1, PREG_SPLIT_NO_EMPTY));

        echo '<pre>' . PHP_EOL;
        for ($y = 0; $y < $this->getHeight(); $y++) {
            for ($x = 0; $x < $this->getWidth(); $x++) {
                $color = $this->_getPixelAt($x, $y);

                // TODO : edit saturation + 0.5
                $mark = $this->calcMark($color);
                echo $chars[(int)($mark * $steps - 1)];
            }
            echo PHP_EOL;
        }
        echo '</pre>' . PHP_EOL;
    }

    /**
     * Display Image
     */
    public function showImage()
    {
        return $this->showImagePng();
    }

    /**
     * Display Image as png
     */
    public function showImagePng()
    {
        header('Content-type: image/png');
        imagepng($this->getSource()->getImage());
    }

    protected function _getPixelAt($x, $y)
    {
        $posX = ceil($x * $this->getScale() * $this->getSource()->getWidthRatio());
        $posY = ceil($y * $this->getScale() * $this->getSource()->getHeightRatio());

        $color = imagecolorat($this->getSource()->getImage(), $posX, $posY);

        return $color;
    }

    public function calcMark($color)
    {
        return $this->_imageResource->getSaturation($color);
    }


    /**
     * @return float|null
     */
    public function getWidth()
    {
        if (!$this->_width) {
            $this->_width = $this->_getWidth();
        }

        return $this->_width;
    }

    /**
     * @return float
     */
    protected function _getWidth()
    {
        $ratio = $this->getSource()->getWidthRatio();

        $width = floor($this->getSource()->getWidth() / $this->getScale() / $ratio);

        return $width;
    }

    /**
     * @return float|null
     */
    public function getHeight()
    {
        if (!$this->_height) {
            $this->_height = $this->_getHeight();
        }

        return $this->_height;
    }

    /**
     * @return float
     */
    protected function _getHeight()
    {
        $ratio = $this->getSource()->getHeightRatio();

        $height = floor($this->getSource()->getHeight() / $this->getScale() / $ratio);

        return $height;
    }


    /**
     * @return bool|void
     * @throws \Exception
     */
    public function getSource()
    {
        return $this->_imageResource;
    }


    /**
     * @param Img2text\Img2text_Abstract $source
     *
     * @return $this
     */
    public function setSource(Img2text\Img2text_Abstract $source)
    {
        $this->_imageResource = $source;
        return $this;
    }

    /**
     * @return int
     */
    public function getScale()
    {
        return $this->_scale;
    }


    /**
     * @param $scale
     *
     * @return $this
     * @throws \Exception
     */
    public function setScale($scale)
    {
        if ($scale < 1) {
            throw new \Exception(self::EXCEPTION_MESSAGE_SCALE);
        }

        $this->_scale = abs((float)$scale);
        return $this;
    }

    /**
     * @return string
     */
    public function getChars()
    {
        return $this->_chars;
    }

    /**
     * @param string $chars
     *
     * @return art
     */
    public function setChars($chars)
    {
        if (!$chars) {
            return;
        }

        $this->_chars = $chars;
        return $this;
    }

}