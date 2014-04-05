<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-5
 * Time: 下午4:33
 */

namespace Expbenson\AppInfo;


class AppInfoException extends \Exception {

    const INVALID_FILE_TYPE = 1;

    const FILE_NOT_FOUND = 2;

    const PARSE_FAIL = 3;

    const WRONG_FILE_FORMAT = 4;

    const NOT_READABLE = 5;

    public function __construct($errorMessage, $errorCode)
    {
        parent::__construct($errorMessage, $errorCode);
    }

    public static function invalidFileType($errorMessage = '')
    {
        return new self($errorMessage, self::INVALID_FILE_TYPE);
    }

    public static function fileNotFound($errorMessage = '')
    {
        return new self($errorMessage, self::FILE_NOT_FOUND);
    }

    public static function parseFail($errorMessage = '')
    {
        return new self($errorMessage, self::PARSE_FAIL);
    }

    public static function wrongFileFormat($errorMessage = '')
    {
        return new self($errorMessage, self::WRONG_FILE_FORMAT);
    }

    public static function notReadable($errorMessage = '')
    {
        return new self($errorMessage, self::NOT_READABLE);
    }
}