<?php

namespace Models;

use Core\QueryBuilder;

class User {

    protected $qb;
    
    public function __construct() {
        $this->qb = new QueryBuilder;
    }

    public function all() {

        $this->qb->select('email');
        $this->qb->from('users');
        $this->qb->limit(2);
        
        $users = $this->qb->result();

        return $users;
    }

    public function register($email) {

        return $this->qb->insert('users', [
            'email' => $email
        ]);
        
    }
}