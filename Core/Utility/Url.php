<?php

/**
 * Url
 * 
 * For url handling.
 * 
 * @author Gemblue
 */

namespace Core\Utility;

class Url {

    /**
     * Get base url.
     */
    public static function base() {
        $config = require '../config/main.php';
        
        return $config['base_url'];
    }

    /**
     * Redirect url.
     */
    public static function redirect($path = null) {
        
        $path = Url::base() . $path;

        echo '<meta http-equiv="refresh" content="0; url='. $path . '">';
        exit;

    }
}