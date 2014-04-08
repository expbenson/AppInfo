<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午7:56
 */

namespace Expbenson\AppInfo;

use CFPropertyList\CFArray;
use CFPropertyList\CFDictionary;
use CFPropertyList\CFPropertyList;
use CFPropertyList\CFString;
use CFPropertyList\IOException;
use CFPropertyList\PListException;

/**
 * Class IosApp
 * @package Expbenson\AppInfo
 */
class IosApp extends App
{
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
        $ipa = new \ZipArchive();
        if (true !== $ipa->open($this->file)) {
            throw AppInfoException::invalidFileType('Not ipa file.');
        }

        $infoPlist = null;
        for ($i = 0, $filesCount = $ipa->numFiles; $i < $filesCount; $i++) {
            if (preg_match('/Payload\/[^\/]+\/Info\.plist/', $ipa->getNameIndex($i))) {
                $infoPlist = $ipa->getFromIndex($i);
                $i         = $filesCount;
            }
        }
        if (null === $infoPlist) {
            throw AppInfoException::fileNotFound();
        }

        $plist = new CFPropertyList();
        try {
            $plist->parse($infoPlist, CFPropertyList::FORMAT_AUTO);
        } catch (PListException $e) {
            throw AppInfoException::wrongFileFormat($e->getMessage());
        } catch (IOException $e) {
            throw AppInfoException::notReadable($e->getMessage());
        } catch (\DOMException $e) {
            throw AppInfoException::parseFail($e->getMessage());
        }

        $plistArray = $plist->toArray();
//        print_r($plistArray);
        $this->id = $plistArray['CFBundleIdentifier'];
        if (isset($plistArray['CFBundleDisplayName'])) {
            $this->name = $plistArray['CFBundleDisplayName'];
        } else {
            $this->name = $plistArray['CFBundleName'];
        }
        $this->version     = $plistArray['CFBundleShortVersionString'];
        $this->versionCode = $plistArray['CFBundleVersion'];

        $ipa->close();
    }

    public function generatePlist($appDownloadUrl)
    {
        $plist = new CFPropertyList();
        $plist->add($dict = new CFDictionary());
        $dict->add('items', $itemArr = new CFArray());
        $itemArr->add($itemDict = new CFDictionary());
        $itemDict->add('assets', $kindArr = new CFArray());
        $kindArr->add($kindDict = new CFDictionary());
        $kindDict->add('kind', new CFString('software-package'));
        $kindDict->add('url', new CFString($appDownloadUrl));
        $itemDict->add('metadata', $metadataDict = new CFDictionary());
        $metadataDict->add('bundle-identifier', new CFString($this->getId()));
        $metadataDict->add('bundle-version', new CFString($this->getVersion()));
        $metadataDict->add('kind', new CFString('software'));
        $metadataDict->add('subtitle', new CFString($this->getName()));
        $metadataDict->add('title', new CFString($this->getName()));

        return $plist->toXML();
    }

}