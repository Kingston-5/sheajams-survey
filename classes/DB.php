<?php
/**
 * manages the applications interactions with the database
 */

class DB {
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;

    /**
     * try to establish the connection to the database
     */
    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * return an instance of this class
     */
    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    /**
     * @param sql - the sql statement to be executed
     * @param params - the parameters of the sql statement
     * 
     * @return the results , errors, full query and row count
     */
    public function query($sql, $params = array()) {
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    /**
     * perform an action on a database table such as a selection
     * @param action - action we want to perform e.g SELECT
     * @param table - name of the table to perform action on 
     * @param where - conditionals of the action
     * @return  errors
     */
    public function action($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }

        }

        return false;
    }

    /**
     * used to insert values into the database
     * @param table - table to insert the data in
     * @param fields - fields to be affected
     * @return true of succesful
     */
    public function insert($table, $fields = array()) {
        
        $keys = array_keys($fields);
        $values = null;
        $x = 1;
        
        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    /**
     * used to update data in the database
     * @param table - table on which to perform the update
     * @param id - id of the row to be affected
     * @param fields - fields to be affected
     * @return true if succesful
     */
    public function update($table, $id, $fields) {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count ($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    /**
     * delete data in the db
     * @param table - table to perform deletion
     * @param where - conditions describing which data to delete
     * @return - true or false
     */
    public function delete($table, $where) {
        return $this->action('DELETE ', $table, $where);
    }

    /**
     * get data from the db
     * @param table - table from where to get data
     * @param where - conditions decsribing which data to get
     * @return - true or false
     */
    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);// select all statement
    }

    /**
     * @return - results of the last query
     */
    public function results() {
        return $this->_results;
    }

    /**
     * @return - first row in the results of the last query
     */
    public function first() {
        $data = $this->results();
        return $data[0];
    }

    /**
     * @return - the number of rows returned by the last query
     */
    public function count() {
        return $this->_count;
    }

    /**
     * @return - errors thrown by the most recent query 
     */
    public function error() {
        return $this->_error;
    }
}