<?php

/**
 * View
 * 
 * Simple stupid view.
 * 
 * @author Gemblue
 */

namespace Core;

use Exception;

class View {

    /** Props */
    public $path = '../View/'; 

    /**
     * View::run
     */
    public function render($file, $args = null) {

        $path = $this->path . $file . '.php';

        if (file_exists($path))
        {
            // Start
            ob_start();

            // Ekstrak array agar dapat dibaca pada template.
            extract($args);

            // Masukan content template.
            include($path);

            // Get Clean
            $content = ob_get_clean();
        } 
        else 
        {
            return new Exception('Missing view file : ' . $path);
        }

        // Show output.
        echo $content;
    }
}