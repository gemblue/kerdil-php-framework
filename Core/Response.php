<?php

/**
 * Response
 * 
 * For handling http response.
 * 
 * @author Gemblue
 */

namespace Core;

use json_encode;

class Response {

    /** Props */
    public $headers = [];

    /**
     * Response::SetHeader
     */
    public function setHeader(string $header) {
        
        $this->headers[] = $header;
        
        return $this;
        
    }

    /**
     * Response::ShowJSON
     */
    public function showJSON(array $param)  {
        
        foreach($this->headers as $header) {
            header($header);
        }

        echo json_encode($param);
    }
}