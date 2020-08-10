<?php

namespace Core;

class Router {

    public $path;
    public $collections = [];

    public function __construct() {

        // Pada saat router dipanggil, ambil current path yang sedang diakses.
        $this->path = $_SERVER['PATH_INFO'];
    }
    
    public function get($address, $controller, $method = null) : void {
        
        // Masukan semua kebutuhan uri kedalam suatu collections.
        $this->collections[] = [
            'http' => 'GET',
            'address' => $address,
            'controller' => $controller,
            'method' => $method
        ];
    }

    private function runController($controller, $method) : void {
        
        /** Is it closure? */
        if (is_callable($controller)) {
            
            $controller();
            
            return;
        }

        /** Pointing ke controller, baik di folder utama maupun modules. */
        $path = "../Controllers/" . $controller . ".php";
        
        if (file_exists($path)) {
            
            /** Instantiate and run method */
            require_once "../Controllers/$controller.php";
            
            $classPath = "Controllers\\$controller";
            
            call_user_func([(new $classPath()), $method]);
            
            return;
        }

        /** HMVC handling, separate controller path first, find module folder name and controller. */
        $module = explode('/', $controller);
        
        require_once "../Modules/$module[0]/Controllers/$module[1].php";
        
        $classPath = "$module[0]\\Controllers\\$module[1]";
        
        call_user_func([(new $classPath()), $method]);
    }

    public function run() : void {

        // Bandingkan koleksi perintah routing dengan current url yang sedang diakses. Cocokan lalu eksekusi.
        foreach($this->collections as $collection) {

            if ($collection['address'] == $this->path) {
                
                // Jika ada yang terdaftar. Eksekusi  
                $this->runController($collection['controller'], $collection['method']);

                return;

            } else {

                header("HTTP/1.0 404 Not Found");
                
            }

        }

    }
}