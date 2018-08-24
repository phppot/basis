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
        U::buildAry($ary, "username", $_POST["signup-email"]);
        U::buildAry($ary, "email", $_POST["signup-email"]);
        if (! empty($_POST["signup-password"])) {
            $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT);
            U::buildAry($ary, "password", $hashedPassword);
        }
        if (! empty($_POST["signup-country"])) {
            U::buildAry($ary, "country", $_POST["signup-country"]);
        }
        if (! empty($_POST["signup-phone"])) {
            U::buildAry($ary, "phone", $_POST["signup-phone"]);
        }
        if (! empty($_POST["signup-name"])) {
            U::buildAry($ary, "member_name", $_POST["signup-name"]);
        }

        U::buildAry($ary, "role", $role);
        if (! empty($_POST["address"])) {
            U::buildAry($ary, "address", $_POST["address"]);
        }
        if (! empty($_POST["city"])) {
            U::buildAry($ary, "city", $_POST["city"]);
        }
        if (! empty($_POST["state"])) {
            U::buildAry($ary, "state", $_POST["state"]);
        }
        if (! empty($_POST["zip"])) {
            U::buildAry($ary, "zip", $_POST["zip"]);
        }
        $member_slug = $this->getMemberSlug($_POST["signup-email"]);
        U::buildAry($ary, "member_slug", $member_slug);
        if (! empty($status)) {
            U::buildAry($ary, "status", $status);
        } else {
            U::buildAry($ary, "status", 0);
        }
        U::buildAry($ary, "signup_type", "General");
        U::buildAry($ary, "create_at", date("Y-m-d H:i:s"));
        return $ary;
    }

    public function register($role, $status = "")
    {
        $ary = $this->registerProcessUi($role, $status);
        $result = $this->insert($ary);
        return $result;
    }
}
