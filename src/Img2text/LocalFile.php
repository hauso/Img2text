<?php
/**
 * Author: Tomas Domanik
 * Date: 31.10.2015
 */

namespace HausO\Img2text\Img2text;

class LocalFile
    extends Img2text_Abstract
{
    protected $_heightRatio = 2.5;
    protected $_file = false;

    const EXCEPTION_MESSAGE_FILE_NOT_SET = 'File is not set!';
    const EXCEPTION_MESSAGE_FILE_NOT_EXISTS = 'File not exists!';
    const EXCEPTION_MESSAGE_FILE_TYPE_ = 'File not exists!';

    public function createResource()
    {
        if(!$this->getFile()) {
            throw new \Exception(self::EXCEPTION_MESSAGE_RESOURCE_NOT_SET);
        }

        $resource = imagecreatefromstring(file_get_contents($this->getFile()));
        $this->setResource($resource);

        return $this;
    }


    /**
     * @return boolean
     */
    public function getFile()
    {
        return $this->_file;
    }


    /**
     * @param $file
     *
     * @return $this
     * @throws \Exception
     */
    public function setFile($file)
    {
        $this->checkFile($file);

        $this->_file = $file;
        return $this;
    }

    public function checkFile($file)
    {
        if(!file_exists($file)) {
            throw new \Exception(self::EXCEPTION_MESSAGE_FILE_NOT_EXISTS);
        }
    }


}