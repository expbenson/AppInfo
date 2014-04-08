<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午8:00
 */

namespace Expbenson\AppInfo;

use ApkParser\Parser;

/**
 * Class AndroidApp
 * @package Expbenson\AppInfo
 */
class AndroidApp extends App
{

    /**
     * @var string
     */
    private $manifest;

    /**
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->parseDescriptionFile();
    }

    /**
     * @throws AppInfoException
     */
    protected function parseDescriptionFile()
    {

        try {
            $apk = new Parser($this->file);
        } catch (\Exception $e) {
            throw AppInfoException::invalidFileType($e->getMessage());
        }

        $this->manifest = $apk->getManifest();
//        echo sprintf("\n\n%s\n", $this->manifest->getXmlString());
        try {
            $this->id          = $this->manifest->getPackageName();
            $this->name        = $this->getAppName();
            $this->version     = $this->manifest->getVersionName();
            $this->versionCode = $this->manifest->getVersionCode();
        } catch (\Exception $e) {
            throw AppInfoException::parseFail($e->getMessage());
        }
    }

    /**
     * @return string
     */
    private function getAppName()
    {
        if (preg_match('/<application.+?name="([^"]+)"/', $this->manifest, $match)) {
            return $match[1];
        } else {
            return $this->getId();
        }
    }
} 