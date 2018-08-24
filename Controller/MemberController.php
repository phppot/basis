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
            case "member-add":
                $this->handleAdd();
                break;
        }
    }

    public function handleAdd()
    {
        require_once './Common/MemberPrivilegeValidate.php';
        $this->loadCtx(true, true, true, true);
        $page_heading = "Member Add";
        $selectedMenu = "Member";
        require_once "./Common/Util.php";
        if (! empty($_POST["add"])) {
            $email = $this->memberModel->getByField("email", $_POST["signup-email"]);
            if (! empty($email)) {
                $message = "Email already exists!";
            }
            if (empty($message)) {
                $status = "1";
                $memberId = $this->memberModel->register($_POST["role"], $status);
                if (! empty($this->appProperty) && $this->appProperty[0]["is_welcome_email"] && $this->appProperty[0]["smtp_auth"] == "1") {
                    $memberResult = $this->memberModel->getById($memberId);
                }
                if (! empty($memberId)) {
                    $this->u->storeSess("message", "Member added successfully.");
                }
                $this->u->redirect("member/");
            }
        }
        require_once 'view/member-add-admin.php';
    }
}
