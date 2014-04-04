<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午7:56
 */

namespace Expbenson\AppInfo;

class IosApp extends App {

    public function __construct()
    {
        $this->name = 'ios app';
        $this->version = '1.0';
        $this->versionCode = 2;
    }
} 