<?php

/**
 * Request
 * 
 * For handling http request, cleaning it with xss etc.
 * 
 * @author Gemblue
 */

namespace Core;

class Request {

    public function get(string $key = null)  {
        
        $get = $this->clean($_GET);

        if ($key != null)
            return $get[$key];
        
        return $get;
    }

    public function post(string $key = null)  {
        
        $post = $this->clean($_POST);
        
        if ($key != null)
            return $post[$key];
        
        return $post;
    }

    private function clean(array &$param) {

        foreach($param as $key => $value) {
            
            $param[$key] = filter_var($value, FILTER_SANITIZE_STRING);
            
        }
        
        return $param;
    }
}