<?php
/**
 * Created by PhpStorm.
 * User: benson
 * Date: 14-4-5
 * Time: 下午4:33
 */

namespace Expbenson\AppInfo;


/**
 * Class AppInfoException
 * @package Expbenson\AppInfo
 */
class AppInfoException extends \Exception {

    /**
     * Flag telling the File is invalid
     */
    const INVALID_FILE_TYPE = 1;

    /**
     * Flag telling the File could not be found
     */
    const FILE_NOT_FOUND = 2;

    /**
     * Flag telling the File could not be parsed
     */
    const PARSE_FAIL = 3;

    /**
     * Flag telling the File format is wrong
     */
    const WRONG_FILE_FORMAT = 4;

    /**
     * Flag telling the File could not be read
     */
    const NOT_READABLE = 5;

    /**
     * @param string $errorMessage
     * @param int $errorCode
     */
    public function __construct($errorMessage, $errorCode)
    {
        parent::__construct($errorMessage, $errorCode);
    }

    /**
     * @param string $errorMessage
     * @return AppInfoException
     */
    public static function invalidFileType($errorMessage = '')
    {
        return new self($errorMessage, self::INVALID_FILE_TYPE);
    }

    /**
     * @param string $errorMessage
     * @return AppInfoException
     */
    public static function fileNotFound($errorMessage = '')
    {
        return new self($errorMessage, self::FILE_NOT_FOUND);
    }

    /**
     * @param string $errorMessage
     * @return AppInfoException
     */
    public static function parseFail($errorMessage = '')
    {
        return new self($errorMessage, self::PARSE_FAIL);
    }

    /**
     * @param string $errorMessage
     * @return AppInfoException
     */
    public static function wrongFileFormat($errorMessage = '')
    {
        return new self($errorMessage, self::WRONG_FILE_FORMAT);
    }

    /**
     * @param string $errorMessage
     * @return AppInfoException
     */
    public static function notReadable($errorMessage = '')
    {
        return new self($errorMessage, self::NOT_READABLE);
    }
}