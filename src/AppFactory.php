<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午7:58
 */

namespace Expbenson\AppInfo;

class AppFactory {

    public static function Create($type)
    {
        if ('ipa' === $type) {
            return new IosApp();
        } else {
            return new AndroidApp();
        }
    }
} 