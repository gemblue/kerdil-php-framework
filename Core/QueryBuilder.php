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

    /** 
     * Untuk meyimpan SQL sintaks final
     */
    public $command;

    /**
     * Menyimpan koneksi socket
     */
    public $connection;

    /**
     * Menyimpan query chain.
     */
    public $select = null;
    public $from = null;
    public $where = [];
    public $join = null;
    public $groupBy = null;

    /**
     * Pilihan fetch.
     */
    public $fetch = false;

    public function __construct() {
        
        $config = require '../config/database.php';

        try {

            $this->connection = new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['database'], $config['user'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
        
            echo $e->getMessage();
            
            return;
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
    public function join(string $table, string $relation) {
        
        $this->join = ' JOIN ' . $table . ' ON ' . $relation;

        return $this;
    
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
    public function groupBy(string $by) {
        
        $this->groupBy = ' GROUP BY ' . $by;

        return $this;

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

        if ($this->join != null)
            $command .= $this->join;
        
        if ($this->groupBy != null)
            $command .= $this->groupBy;
        
        if ($this->limit != null)
            $command .= $this->limit;

        $this->command = $command;
        
        return $this->fetch()->run();
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
     * QB::withFetch
     * 
     * Set agar API mengeluarkan data output
     */
    public function fetch() {
        
        $this->fetch = true;
        
        return $this;
        
    }

    /**
     * QB::run
     * 
     * Run SQL or No SQL, dengan fetch atau tidak.
     */
    public function run() {

        $statement = $this->connection->prepare($this->command);
        
        if ($statement->execute()) {

            if ($this->fetch) {
                
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                
                return $statement->fetchAll(PDO::FETCH_OBJ);
            
            } 
            
            return true;
        }
        
        return false;
    }
}