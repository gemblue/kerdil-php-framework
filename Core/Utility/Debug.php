<?php

/**
 * Debug
 * 
 * For debug purpose.
 * 
 * @author Gemblue
 */

namespace Core\Utility;

class Debug {

    public static function dump(array $param, $exit = 0) {

        echo '<pre>';
        print_r($param);
        echo '</pre>';
        
        if ($exit) exit();
    }

}