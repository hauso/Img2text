<?php
/**
 * Author: Tomas Domanik
 * Date: 31.10.2015
 */

$baseDir = dirname(__FILE__) . DIRECTORY_SEPARATOR;

$libDir = $baseDir . 'HausO_Img2text' . DIRECTORY_SEPARATOR;
require_once($libDir . 'Img2text/SourceInterface.php');
require_once($libDir . 'Img2text/SourceAbstract.php');
require_once($libDir . 'Helper/Text.php');
require_once($libDir . 'Img2text/File.php');
require_once($libDir . 'Img2text.php');


try {

    if (isset($_GET['s'])) {
        $s = html_entity_decode($_GET['s']);
        $w = strlen($s) * 12.5;

        $src = new HausO_Img2text\Helper\Text();
        $src->setText($s)
            ->setHeight(25)
            ->setWidth($w)
            ->createImage();
    } else {
        $imgDir = $baseDir . 'data' . DIRECTORY_SEPARATOR;
        $images = array(
            $imgDir . 'hauso.jpg',
            $imgDir . 'touch_of_adrenaline.jpg',
            $imgDir . 'pat_mat.jpg',
            $imgDir . 'pray-for-paris.jpg',
        );

        $imgIndex = html_entity_decode($_GET['i']);

        if (isset($_GET['i']) && isset($images[$imgIndex])) {
            $imgSrc = $images[$imgIndex];
        } else {
            $imgSrc = $images[1];
        }

        $src = new HausO_Img2text\Helper\File();
        $src->setFile($imgSrc);
    }

    if (isset($_GET['chars'])) {
        $chars = html_entity_decode($_GET['chars']);
    } else {
        $chars = '%OI+:.  ';
        //$chars = '% ';
    }


    /** @var HausO\Img2text\Img2text $i2t */
    $i2t = new HausO_Img2text\Img2text();
    $i2t->setSource($src)
        ->setChars($chars);

    if (isset($_GET['scale']) && is_numeric($_GET['scale'])) {
        $scale = html_entity_decode($_GET['scale']);
        $i2t->setScale((float)$scale);
    }

    if (isset($_GET['src'])) {
        $i2t->showImage();
    } else {
        $i2t->draw();
    }

} catch (Exception $e) {
    echo $e->getMessage();
}


