<?php
namespace PhpPot\Controller;

use \PhpPot\Controller\MemberController;

class Dispatcher
{

    public function __construct()
    {
        require_once "./Common/Config.php";
        require_once "./Controller/iRequestHandler.php";
        require_once "./Controller/Controller.php";
    }

    public function dispatch()
    {
        $func = $this->getGetParam("func");

        switch ($func) {
            case "member":
                require_once './Controller/MemberController.php';
                $memberController = new MemberController($func);
                $memberController->handleRequest();
                break;
            default:
                require_once './Controller/HomeController.php';
                $homeController = new HomeController($func);
                $homeController->handleRequest();
                break;
        }
    }

    private function getGetParam($paramName)
    {
        $paramValue = "";
        if (! empty($_GET[$paramName])) {
            $paramValue = $_GET[$paramName];
        }
        return $paramValue;
    }
}