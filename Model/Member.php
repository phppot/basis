<?php
namespace PhpPot\Model;

use PhpPot\Dao\EntityDaoDecorator;
use PhpPot\Common\Util as U;

/*
 * This class is a domain and DAO class.
 * Mostly it does data access.
 * In selected functions, it includes business logic also.
 */
class Member extends EntityDaoDecorator
{

    public $tblName = "tbl_member";

    /*
     * TO REGISTER NEW MEMBER
     */
    public function registerProcessUi($role, $status)
    {
        $ary = null;
        U::buildAry($ary, "email", $_POST["signup-email"]);
        if (! empty($_POST["signup-password"])) {
            $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT);
            U::buildAry($ary, "password", $hashedPassword);
        }
        if (! empty($_POST["signup-name"])) {
            U::buildAry($ary, "member_name", $_POST["signup-name"]);
        }
        U::buildAry($ary, "create_at", date("Y-m-d H:i:s"));
        return $ary;
    }

    public function register()
    {
        $ary = $this->registerProcessUi();
        $result = $this->insert($ary);
        return $result;
    }
}
