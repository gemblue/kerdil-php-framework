<?php

/**
 * Query Builder
 * 
 * Simple QB for Kerdil.
 * 
 * @author Gemblue
 */

namespace Core;

use PDO;

class QueryBuilder {

    /** Props */
    public $command;
    public $connection;
    public $select = null;
    public $from = null;
    public $where = [];

    public function __construct() {
        
        $servername = "localhost";
        $username = "app";
        $password = "12345678";
        $database = "_temp";

        try {

            $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
        
            echo "Connection failed: " . $e->getMessage();
        
        }
    }

    /**
     * QB::select
     */
    public function select(string $field = '*') {
        
        if (is_null($field)) {
            $this->select = 'SELECT *'; 
        }

        $this->select = 'SELECT ' . $field;
        
        return $this;

    }

    /**
     * QB::from
     */
    public function from(string $table, string $condition = null) {
        
        $this->from = ' FROM ' . $table;

        return $this;
        
    }

    /**
     * QB::join
     */
    public function join(string $table) {
        
    }

    /**
     * QB::where
     */
    public function where() {

    }

    /**
     * QB::limit
     */
    public function limit($limit, $order = 0) {

        $this->limit = ' LIMIT ' . $order . ', ' . $limit;

        return $this;

    }

    /**
     * QB::groupBy
     */
    public function groupBy() {
        
    }

    /**
     * QB::results
     * 
     * Compile all piece, run command
     */
    public function result() {

        $command = null;

        if ($this->select != null)
            $command = $this->select;

        if ($this->from != null)
            $command .= $this->from;
        
        if ($this->limit != null)
            $command .= $this->limit;

        $this->command = $command;
        
        return $this->run(true);
    }

    /**
     * QB::insert
     */
    public function insert(string $table, array $fields) {

        /** Transform field into string */
        $set = '';

        foreach($fields as $key => $value) {
            $set .= $key . '="' . $value . '" ';
        }

        /** Build */
        $this->command = 'INSERT INTO ' . $table . ' SET ' . $set;
        
        return $this->run();
    }

    /**
     * QB::setCommand
     */
    public function setCommand(string $command) {
        
        $this->command = $command;
        
        return $this;
        
    }

    /**
     * QB::run
     * 
     * Run SQL or No SQL
     */
    public function run($fetch = false) {

        $statement = $this->connection->prepare($this->command);
        
        if ($statement->execute()) {

            if ($fetch) {
                
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                
                return $statement->fetchAll(PDO::FETCH_OBJ);
            
            } 
            
            return true;
        }
        
        return false;
    }
}