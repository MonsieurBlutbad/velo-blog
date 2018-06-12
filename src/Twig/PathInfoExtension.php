<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 01.06.18
 * Time: 11:47
 */
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigTest;

class PathInfoExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new TwigFilter('ext', array($this, 'ext')),
        );
    }

    /**
     * @return array
     */
    public function getTests()
    {
        return array(
            new TwigTest('is_image', array($this, 'isImage')),
        );
    }

    /**
     * @param $filepath
     * @return mixed
     */
    public function ext($filepath)
    {
        return pathinfo($filepath, PATHINFO_EXTENSION);
    }

    /**
     * @param $filepath
     * @return bool
     */
    public function isImage($filepath)
    {
        $ext = pathinfo($filepath, PATHINFO_EXTENSION);
        return in_array(strtolower($ext), ['jpg', 'jpeg', 'bmp', 'gif', 'png'], true);
    }

}