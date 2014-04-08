<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午7:58
 */

namespace Expbenson\AppInfo;

/**
 * Class AppFactory
 * @package Expbenson\AppInfo
 */
class AppFactory
{

    /**
     * @param $file
     * @return AndroidApp|IosApp
     * @throws AppInfoException
     */
    public static function Create($file)
    {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if ('ipa' === $extension) {
            return new IosApp($file);
        } elseif ('apk' === $extension) {
            return new AndroidApp($file);
        } else {
            throw AppInfoException::invalidFileType();
        }
    }
} 