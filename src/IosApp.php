<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-4
 * Time: 下午7:56
 */

namespace Expbenson\AppInfo;

use CFPropertyList\CFPropertyList;
use CFPropertyList\IOException;
use CFPropertyList\PListException;

class IosApp extends App
{
    public function __construct($file)
    {
        $this->file = $file;
        $this->parseDescriptionFile();
    }

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
        if (isset($plistArray['CFBundleDisplayName'])) {
            $this->name = $plistArray['CFBundleDisplayName'];
        } else {
            $this->name = $plistArray['CFBundleName'];
        }
        $this->version     = $plistArray['CFBundleVersion'];
        $this->versionCode = 0;

        $ipa->close();
    }

}