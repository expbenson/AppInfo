<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午7:51
 */

namespace Expbenson\AppInfo;

abstract class App {

    protected $name;

    protected $version;

    protected $versionCode;

    public function getName()
    {
        return $this->name;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getVersionCode()
    {
        return $this->versionCode;
    }
}