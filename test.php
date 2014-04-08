<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午8:01
 */

require 'vendor/autoload.php';

$app = Expbenson\AppInfo\AppFactory::Create('android.apk');

echo sprintf(
    "\nName:\t\t%s\nVersion:\t%s\nVersionCode:\t%s\n\n",
    $app->getName(),
    $app->getVersion(),
    $app->getVersionCode()
//    $app->generatePlist('http://www.baidu.com/')
);