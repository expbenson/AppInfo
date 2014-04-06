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
class AndroidApp extends App {

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

        $manifest = $apk->getManifest();
        try {
            $this->name = $manifest->getPackageName();
            $this->version = $manifest->getVersionName();
            $this->versionCode = $manifest->getVersionCode();
        } catch (\Exception $e) {
            throw AppInfoException::parseFail($e->getMessage());
        }
    }
} 