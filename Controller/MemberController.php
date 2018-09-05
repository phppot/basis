<?php
namespace PhpPot\Controller;

use \PhpPot\Model\Member;

class MemberController extends Controller
{

    private $func;

    private $selectedMenu = "Member";

    private $memberModel;

    public function __construct($func)
    {
        parent::__construct($func);
        $this->func = $func;
        require_once './Model/Member.php';
        $this->memberModel = new Member();
        parent::setModel($this->memberModel);
    }

    public function handleRequest()
    {
        parent::handleRequest();
        $page_key = $_GET["page_key"];
        switch ($page_key) {
            case "signup":
                $this->handleAdd();
                break;
        }
    }

    public function handleAdd()
    {
        $page_heading = "Signup";
        $selectedMenu = "Member";
        require_once "./Common/Util.php";
        if (! empty($_POST["register"])) {
            if (empty($message)) {
                $status = "1";
                $memberId = $this->memberModel->register();
                if (! empty($memberId)) {
                    $this->u->storeSess("message", "Member added successfully.");
                }
            }
        }
        require_once 'view/member-signup.php';
    }
}
