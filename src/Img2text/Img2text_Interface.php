<?php
/**
 * Author: Tomas Domanik
 */

namespace HausO\Img2text\Img2text;

/**
 * Interface Img2text_Interface
 *
 * @package Img2text
 */
interface Img2text_Interface
{
    /**
     * @return mixed
     */
    public function getResource();

    /**
     * @return mixed
     */
    public function getWidth();

    /**
     * @return mixed
     */
    public function getHeight();

    /**
     * @return mixed
     */
    public function getWidthRatio();

    /**
     * @return mixed
     */
    public function getHeightRatio();
}