<?php
/**
 * Author: Tomas Domanik
 */

namespace HausO\Img2text\Img2text;

abstract class Img2text_Abstract
    implements Img2text_Interface
{
    protected $_resource = false;
    protected $_widthRatio = 1;
    protected $_heightRatio = 1;

    const EXCEPTION_MESSAGE_WRONG_RESOURCE = 'Resource must be Image(gd), "%s" given';
    const EXCEPTION_MESSAGE_RESOURCE_NOT_SET = 'Resource Image not set';
    const EXCEPTION_MESSAGE_WIDTH_RATIO = 'Width Ratio must be numeric, "%s" is %s';
    const EXCEPTION_MESSAGE_HEIGHT_RATIO = 'Height Ratio must be numeric, "%s" is %s';

    abstract public function createResource();

    public function setResource($ir)
    {
        if(!is_resource($ir) || get_resource_type($ir) != 'gd') {
            if(gettype($ir) != 'resource') {
                $type = gettype($ir);
            } else {
                $type = get_resource_type($ir);
            }

            $message = sprintf(self::EXCEPTION_MESSAGE_WRONG_RESOURCE, $type);
            throw new \Exception($message);
        }

        $this->_resource = $ir;

        return $this;
    }


    public function getResource()
    {
        if(!$this->_resource) {
            throw new \Exception(self::EXCEPTION_MESSAGE_RESOURCE_NOT_SET);
        }

        return $this->_resource;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getWidth()
    {
        $resource = $this->getResource();

        $width = imagesx($resource);

        return $width;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getHeight()
    {
        $resource = $this->getResource();

        $height = imagesy($resource);

        return $height;
    }

    /**
     * @return int
     */
    public function getWidthRatio()
    {
        return $this->_widthRatio;
    }

    /**
     * @param int $widthRatio
     *
     * @return SourceAbstract
     * @throws \Exception
     */
    public function setWidthRatio($widthRatio)
    {
        if(!is_numeric($widthRatio)){
            $message = sprintf(
                self::EXCEPTION_MESSAGE_WIDTH_RATIO,
                $widthRatio, gettype($widthRatio)
            );

            throw new \Exception($message);
        }

        $this->_widthRatio = (float)$widthRatio;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeightRatio()
    {
        return $this->_heightRatio;
    }


    /**
     * @param int $heightRatio
     *
     * @return SourceAbstract
     * @throws \Exception
     */
    public function setHeightRatio($heightRatio)
    {
        if(!is_numeric($heightRatio)){
            $message = sprintf(
                self::EXCEPTION_MESSAGE_HEIGHT_RATIO,
                $heightRatio, gettype($heightRatio)
            );

            throw new \Exception($message);
        }

        $this->_heightRatio = $heightRatio;
        return $this;
    }


    /**
     * @param $data
     *
     * @return float
     * @throws \Exception
     */
    public function getSaturation($data)
    {
        $resource = $this->getResource();

        $cols = imagecolorsforindex($resource, $data);
        $r = $cols['red'];
        $g = $cols['green'];
        $b = $cols['blue'];
        $sat = ($r + $g + $b) / (255 * 3);

        return $sat;
    }


}