<?php

/**
 * Query Builder
 * 
 * Simple QB for Kerdil.
 * 
 * @author Gemblue
 */

namespace Core;

class QueryBuilder {

    /** Props */
    public $command;

    public function __construct() {
        echo 'QB instantiated <br/>';
    }

    /**
     * QB::select
     */
    public function select($param = '*') {

    }

    /**
     * QB::from
     */
    public function from(string $table) {

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
    public function limit() {

    }

    /**
     * QB::groupBy
     */
    public function groupBy() {
        
    }

    /**
     * QB::setCommand
     */
    public function setCommand(string $param) {
        
        $this->command = $param;

        return $this;
        
    }

    /**
     * QB::run
     * 
     * Run SQL or No SQL
     */
    public function run() {

        $connection = mysqli_connect('localhost', 'app', '12345678', '_codepolitan');

        $query = mysqli_query($connection, $this->command);
        
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
        
    }

}