<?php
namespace PhpPot\Controller;

use \PhpPot\Controller\Controller;
use \PhpPot\Model\Member;

class HomeController extends Controller
{

    private $func;

    private $memberModel;

    public function __construct($func)
    {
        parent::__construct($func);
        $this->func = $func;
        require_once './Model/Member.php';
        $this->memberModel = new Member();
    }

    public function handleRequest()
    {
        parent::handleRequest();
        $page_key = $this->getGetParam("page_key");
        switch ($page_key) {
            default:
                $this->handleWorkRoot();
                break;
        }
    }

    public function handleWorkRoot()
    {
        $page_heading = "Home";
        //$this->loadCtx(true, true, true, true);
        require_once "./view/home.php";
    }
}
