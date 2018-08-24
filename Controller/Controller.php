<?php
namespace PhpPot\Controller;

use PhpPot\Common\Util;
use PhpPot\Model\Member;

/**
 * Common controller contract
 *
 * @author Cycle
 *
 * @version 1.3 - $Log Activity added
 */
abstract class Controller implements iRequestHandler
{

    private $func;

    private $selectedMenu;

    private $iModel;

    protected $u;

    protected $appProperty;

    protected $sessMember;

    protected $privilegeMenuAry;

    public function __construct($func)
    {
        $this->func = $func;
        require_once "./Model/iModel.php";
        require_once "./Dao/EntityDaoDecorator.php";
        require_once "./Common/Util.php";
        $this->u = new Util();
    }
    public function setModel($model)
    {
        $this->iModel = $model;
    }

    public function setSelectedMenu($selectedMenu)
    {
        $this->selectedMenu = $selectedMenu;
    }

    /**
     *
     * @param boolean $isLoadAppProperty
     *            - should the application property data be loaded
     * @param boolean $isLoadSessMember
     *            - should the session member data be loaded
     * @param boolean $isLoadMenu
     *            - should the menu used in sidebar be loaded
     * @param boolean $isLogActivity
     *            - should this current request be logged in analytics table
     */
    public function loadCtx($isLoadAppProperty, $isLoadSessMember, $isLoadMenu, $isLogActivity = null)
    {
        if ($isLoadSessMember) {
            $this->getSessMember();
        }
    }

    public function getSessMember()
    {
        $sessMemberId = $this->u->getSess("member_id");
        if (! empty($sessMemberId)) {
            if (empty($this->sessMember)) {
                require_once "./Model/Member.php";
                $memberModel = new Member();
                $this->sessMember = $memberModel->getById($sessMemberId);
            }
            return $this->sessMember;
        }
    }

    /**
     * Handles the standard common request entry point.
     * This can be overridden in extending controller
     * and add more cases.
     * Use code parent::handleRequest(); to access this
     * for the standard cases and add your additional cases
     */
    public function handleRequest()
    {
        $page_key = $this->getGetParam("page_key");
        switch ($page_key) {
            case "add":
                $this->handleAdd();
                break;
            case "edit":
                $this->handleEdit();
                break;
            case "delete":
                $this->handleDelete();
                break;
            case "list":
                $this->handleList();
                break;
            case "view":
                $this->handleView();
                break;
        }
    }

    /**
     * Handles the standard add request.
     * Adapter implementation for stub
     * If required overwrite it in extending controller
     * classess and add implementation
     */
    public function handleAdd()
    {
        require_once './Common/MemberPrivilegeValidate.php';
        $this->loadCtx(true, true, true);
        $page_heading = ucfirst($this->func) . " Add";
        if (! empty($_POST["add"])) {
            $id = $this->iModel->add();
            $this->u->storeSess("message", "Added Successfully.");
            $this->u->redirect($this->func . "/");
        }
        require_once "./view/" . $this->func . "-add.php";
    }

    /**
     * Handles the standard edit request.
     * Adapter implementation for stub
     * If required overwrite it in extending controller
     * classess and add implementation
     */
    public function handleEdit()
    {
        require_once './Common/MemberPrivilegeValidate.php';
        $this->loadCtx(true, true, true);
        $page_heading = ucfirst($this->func) . " Edit";
        if (! empty($_POST["edit"])) {
            $this->iModel->editById($_GET["id"]);
            $this->u->storeSess("message", "Edited Successfully.");
            $this->u->redirect($this->func . "/");
        }
        $result = $this->iModel->getById($_GET["id"]);
        require_once "./view/" . $this->func . "-edit.php";
    }

    /**
     * Handles the standard delete request.
     * Adapter implementation for stub
     * If required overwrite it in extending controller
     * classess and add implementation
     */
    public function handleDelete()
    {
        require_once './Common/MemberPrivilegeValidate.php';
        $this->loadCtx(true, false, false);
        $this->iModel->deleteById($_GET["id"]);
        $this->u->storeSess("message", "Deleted Successfully.");
        $this->u->redirect($this->func . "/");
    }

    /**
     * Handles the standard list request.
     * Adapter implementation for stub
     * If required overwrite it in extending controller
     * classess and add implementation
     */
    public function handleList()
    {
        // TODO: add a standard implementation
    }

    /**
     * Handles the standard view request.
     * Adapter implementation for stub
     * If required overwrite it in extending controller
     * classess and add implementation
     */
    public function handleView()
    {
        require_once './Common/MemberPrivilegeValidate.php';
        $this->loadCtx(true, true, true);
        $page_heading = ucfirst($this->func . " View");
        $result = $this->iModel->getById($_GET["id"]);
        require_once "./view/" . $this->func . "-view.php";
    }

    public function getGetParam($paramName)
    {
        $paramValue = "";
        if (! empty($_GET[$paramName])) {
            $paramValue = $_GET[$paramName];
        }
        return $paramValue;
    }
}