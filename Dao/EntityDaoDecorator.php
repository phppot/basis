<?php
namespace PhpPot\Dao;

/**
 * Historically 80% of the code-foot-print involves single entity DB operations
 * for micro, small and medium sized projects.
 * This single entity DB operations has code reuse possibility.
 * This EntityDaoDecorator acts as a bridge between the Entity and Dao
 *
 * @version 2.1
 */
abstract class EntityDaoDecorator
{

    private $dao;

    public $tblName;

    public function __construct()
    {
        require_once "./Dao/Dao.php";
        $this->dao = new Dao($this->tblName);
    }

    /**
     * to add form values to database
     * processUIForm method should be implemented in the sub-class
     *
     * @return number the auto-id of the latest inserted record.
     */
    public function add()
    {
        $ary = $this->processUIForm();
        $id = $this->insert($ary);
        return $id;
    }

    /**
     * this method can be used from domain directly if
     * processUIForm is substituted with a special purpose
     * method
     *
     * @param fields $ary
     * @return number the auto-id of the latest inserted record.
     */
    public function insert($ary)
    {
        $id = $this->dao->insert($ary);
        return $id;
    }
}
