<?php

/**
 * Router
 * 
 * Simple stupid router, inspired by all the modern router outthere.
 * 
 * @author Gemblue
 */

namespace Core;

class Router {

    /** Meyimpan path yang sedang diakses pengguna */
    public $path;

    /** Default route */
    public $default = '/home';

    /** Menyimpan route yang didefinisikan pada config userland */
    public $collections = [];

    public function __construct() {

        // Pada saat router dipanggil, ambil current path yang sedang diakses.
        $this->path = $_SERVER['PATH_INFO'] ?? $this->default;
    }
    
    /**
     * Get
     * 
     * HTTP method GET
     * 
     * @return void
     */
    public function get($address, $controller, $method = null) : void {
        
        // Masukan semua kebutuhan uri kedalam suatu collections.
        $this->collections[] = [
            'http' => 'GET',
            'address' => $address,
            'controller' => $controller,
            'method' => $method
        ];
    }

    /**
     * Scan
     * 
     * Scan registered path, get value inside curly bracket from uri
     * 
     * @return array
     */
    private function scan(string $address) {

        $regex = '/{\K[^}]*(?=})/m';
        preg_match_all($regex, $address, $matches);
        
        return $matches[0];
    }
 
    /**
     * Run Controller
     * 
     * Method for running/instantiate the controller.
     * 
     * @return void
     */
    private function runController(string $path, array $collection) : void {
        
        // Set controller
        $controller = $collection['controller'];
        $method = $collection['method'];

        /** Is it closure? */
        if (is_callable($controller)) {
            
            $controller();
            
            return;
        }

        /** Pointing ke controller, baik di folder utama maupun modules. */
        $path = "../Controllers/" . $controller . ".php";
        
        if (file_exists($path)) {
            
            /** Instantiate and run method */
            require_once($path);
            
            $namespace = "Controllers\\$controller";
        
        } else {

            /** HMVC handling, separate controller path first, find module folder name and controller. */
            $module = explode('/', $controller);

            $path = "../Modules/$module[0]/Controllers/$module[1].php";
            
            require_once($path);
        
            $namespace = "$module[0]\\Controllers\\$module[1]";
        }

        call_user_func([(new $namespace), $method]);
    }

    /**
     * Run
     * 
     * Loop check registered route and then execute it.
     * 
     * @return void
     */
    public function run() {

        // Bandingkan koleksi perintah routing dengan current url yang sedang diakses. Cocokan lalu eksekusi.
        foreach ($this->collections as $collection) {

            if ($collection['address'] == $this->path) {
                
                // Jika ada yang cocok. Eksekusi  
                $this->runController($this->path, $collection);

                return true;

            } else {

                header("HTTP/1.0 404 Not Found");
                
            }

        }

    }
}