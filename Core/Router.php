<?php

declare(strict_types=1);

/**
 * Router
 *
 * Simple stupid router, inspired by all the modern router outthere.
 */

namespace Core;

use function call_user_func;
use function explode;
use function file_exists;
use function header;
use function is_callable;
use function preg_match_all;

class Router
{
    /** @var path */
    public $path;

    /** @var default */
    public $default = '/home';

    /** @var collection */
    public $collections = [];

    public function __construct()
    {
        // Pada saat router dipanggil, ambil current path yang sedang diakses.
        $this->path = $_SERVER['PATH_INFO'] ?? $this->default;
    }

    /**
     * Get
     *
     * HTTP method GET
     */
    public function get(string $address, string $controller, ?string $method = null): void
    {
        // Masukan semua kebutuhan uri kedalam suatu collections.
        $this->collections[] = [
            'http' => 'GET',
            'address' => $address,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    /**
     * Scan
     *
     * Scan registered path, get value inside curly bracket from uri
     */
    private function scan(string $address): mixed
    {
        $regex = '/{\K[^}]*(?=})/m';
        preg_match_all($regex, $address, $matches);

        return $matches[0];
    }

    /**
     * Run Controller
     *
     * Method for running/instantiate the controller.
     */
    private function runController(string $path, mixed $collection): void
    {
        // Set controller
        $controller = $collection['controller'];
        $method     = $collection['method'];

        /** Is it closure? */
        if (is_callable($controller)) {
            $controller();

            return;
        }

        /** Pointing ke controller, baik di folder utama maupun modules. */
        $path = '../Controllers/' . $controller . '.php';

        if (file_exists($path)) {

            /** Instantiate and run method */
            require_once $path;

            $namespace = 'Controllers\\' . $controller;
        } else {

            /** HMVC handling, separate controller path first, find module folder name and controller. */
            $module = explode('/', $controller);

            $path = '../Modules/' . $module[0] . '/Controllers/.' . $module[1] . '.php';

            require_once $path;

            $namespace = $module[0] . '\\Controllers\\' . $module[1];
        }

        call_user_func([(new $namespace()), $method]);
    }

    /**
     * Run
     *
     * Loop check registered route and then execute it.
     */
    public function run(): void
    {
        // Bandingkan koleksi perintah routing dengan current url yang sedang diakses. Cocokan lalu eksekusi.
        foreach ($this->collections as $collection) {
            if ($collection['address'] === $this->path) {
                // Jika ada yang cocok. Eksekusi
                $this->runController($this->path, $collection);
            }

            header('HTTP/1.0 404 Not Found');
        }
    }
}
