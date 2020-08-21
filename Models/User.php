<?php

namespace Models;

use Core\QueryBuilder;

class User {

    protected $qb;
    
    public function __construct() {
        $this->qb = new QueryBuilder;
    }

    public function all() {

        $this->qb->select('name, email')->from('users');
        
        return $this->qb->result();
    }

    public function search() {

        $this->qb->select('any_value(email), any_value(title)')
                 ->from('users')
                 ->join('posts', 'posts.user_id = users.id')
                 ->where([
                    'email' => 'budi@mailinator.com'
                 ])  
                 ->groupBy('email')
                 ->limit(5);
        
        return $this->qb->result();
    }

    public function register($email) {

        return $this->qb->insert('users', [
            'email' => $email
        ]);
        
    }

    public function update() {

        return $this->qb->update('users', [
            'name' => 'Bambang Saja',
            'email' => 'bambangsaja@gmail.com'
        ], [
            'id' => 1
        ]);
        
    }

    public function delete($id = null) {
        
        return $this->qb->delete('users', ['id' => $id]);
        
    }
}