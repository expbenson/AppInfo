<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午7:51
 */

namespace Expbenson\AppInfo;

/**
 * Class App
 * @package Expbenson\AppInfo
 */
abstract class App {

    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var integer
     */
    protected $versionCode;

    /**
     * @return mixed
     */
    abstract protected function parseDescriptionFile();

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return int
     */
    public function getVersionCode()
    {
        return $this->versionCode;
    }
}