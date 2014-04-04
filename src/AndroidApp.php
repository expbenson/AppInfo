<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午8:00
 */

namespace Expbenson\AppInfo;

class AndroidApp extends App {

    public function __construct()
    {
        $this->name = 'android app';
        $this->version = '1.1';
        $this->versionCode = 3;
    }
} 