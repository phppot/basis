<?php
namespace PhpPot\Common;

use \PhpPot\Common\Config;

/**
 *
 * @author Cycle
 * @version 2.6 Build Ary field value empty check revised
 */
class Util
{

    /**
     * To prepare the WHERE condition part of the sql-query
     * we need the conditions array.
     * The platform's DAO uses
     * the conditions array to form the where condition
     * and also to supply values for insert/update
     *
     * example: id=10 AND name=tom
     *
     * @param unknown $ary
     * @param unknown $fieldName
     * @param unknown $fieldValue
     * @param string $condition
     * @param string $fieldType
     */
    public static function buildAry(& $ary, $fieldName, $fieldValue, $fieldType = "s", $condition = "", $operator = "=")
    {
        if ($fieldValue != '' || $fieldValue === 0) {
            $aryIndex = count($ary);
            $ary[$aryIndex]["Field"] = $fieldName;
            $ary[$aryIndex]["Value"] = $fieldValue;
            $ary[$aryIndex]["Type"] = $fieldType;
            $ary[$aryIndex]["Condition"] = $condition;
            $ary[$aryIndex]["Operator"] = $operator;
        }
        return $ary;
    }

    // xss mitigation functions
    public function xssafe($data, $encoding = 'UTF-8')
    {
        return htmlspecialchars($data, ENT_QUOTES | ENT_HTML401, $encoding);
    }

    public function xecho($data)
    {
        echo $this->xssafe($data);
    }

    public function storeSess($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getSess($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public function echoRSess($key)
    {
        if (isset($_SESSION[$key])) {
            $this->xecho($_SESSION[$key]);
            $this->removeSess($key);
        }
    }

    public function removeSess($key)
    {
        unset($_SESSION[$key]);
    }

    public function redirect($url = null)
    {
        $this->redirectUrl(Config::WORK_ROOT . $url);
    }

    public function redirectUrl($url)
    {
        header("Location:" . $url);
        exit();
    }
}
