<?php
namespace PhpPot\Dao;

/**
 * Core DAO class responsible for low level
 * Database operations.
 * Uses MySQLi and PreparedStatement.
 *
 * Lots of conventions in place. Do a thorough analysis
 * before changing the code.
 *
 * @author Cycle
 * @version 3.2 - Removed unused use statement
 *
 */
class Dao
{

    private $conn;

    private $tblName;

    public function __construct($tblName = null)
    {
        require_once "DataSource.php";
        $this->conn = DataSource::getConnection();
        $this->tblName = $tblName;
    }

    /**
     *
     * @param
     *            sql
     */
    private function prepareStmt($sql)
    {
        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conn->errno . ' ' . $this->conn->error, E_USER_ERROR);
        }
        return $stmt;
    }

    /**
     * argument for call_user_func_array should be passed
     * as reference which is going to be subsequently used
     * Therefore we are receiving both arguments as reference.
     *
     * @param unknown $paramFieldAry
     * @param unknown $param_type
     * @return arguments reference array
     */
    private function prepareParams(&$paramFieldAry, &$param_type)
    {
        $paramFieldCount = count($paramFieldAry);
        /* with call_user_func_array, array params must be passed by reference */
        $a_params[] = & $param_type;
        for ($i = 0; $i < $paramFieldCount; $i ++) {
            /* with call_user_func_array, array params must be passed by reference */
            $a_params[] = & $paramFieldAry[$i]["Value"];
        }
        return $a_params;
    }

    /**
     * 1.prepares parameters for binding
     * 2.binds the parameters to statement passed
     * Bind parameters.
     * Types: s = string, i = integer, d = double, b = blob
     *
     * @param
     *            stmt, ...
     *
     */
    private function bindParams($stmt, $paramFieldAry, $param_type)
    {
        // step 1: prepare params before binding
        $a_params = $this->prepareParams($paramFieldAry, $param_type);

        // step 2: bind the parameters to the statement
        /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $a_params);
    }

    /**
     *
     * @return The ID generated for an AUTO_INCREMENT column
     *         by the previous query on success,
     *         0 if the previous query does not generate
     *         an AUTO_INCREMENT value, or
     *         FALSE if no MySQL connection was established.
     */
    public function insert($paramFieldAry, $tableName = null)
    {
        if (is_array($paramFieldAry)) {
            $fields = '';
            $paramType = '';
            $prepareStmtArg = '';
            $i = 0;
            $paramFieldCount = count($paramFieldAry);
            while ($i < $paramFieldCount) {
                if ($i != 0) {
                    $fields .= "," . $paramFieldAry[$i]["Field"] . "";
                    $paramType .= $paramFieldAry[$i]["Type"];
                    $prepareStmtArg .= ",?";
                } else {
                    $fields = $paramFieldAry[$i]["Field"];
                    $paramType = $paramFieldAry[$i]["Type"];
                    $prepareStmtArg = "?";
                }
                $i ++;
            }
        }

        if ($tableName == null) {
            if (! ($this->tblName == null)) {
                $tableName = $this->tblName;
            } else {
                throw new \Exception("Table name not found in INSERT query!");
            }
        }

        $sql = "insert into " . $tableName . " (" . $fields . ") values (" . $prepareStmtArg . ")";
        $stmt = $this->prepareStmt($sql);
        $this->bindParams($stmt, $paramFieldAry, $paramType);
        $stmt->execute();

        $id = mysqli_insert_id($this->conn);
        return $id;
    }
}
