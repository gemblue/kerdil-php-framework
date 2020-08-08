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
        
        // Ini callback?
        if (is_callable($controller)) {
            
            $controller();
            
            return;
        }

        // Bukan, pointing ke controller class.
        require_once "../controllers/$controller.php";

        $classPath = "Controllers\\$controller";
        
        /** Instantiate and run method */
        call_user_func([(new $classPath()), $method]);
    }

    public function run() : void {

        // Bandingkan koleksi perintah routing dengan current url yang sedang diakses. Cocokan lalu eksekusi.
        foreach($this->collections as $collection) {

            if ($collection['address'] == $this->path) {
                
                // Jika ada yang terdaftar. Eksekusi  
                $this->runController($collection['controller'], $collection['method']);

            }

        }

    }
}