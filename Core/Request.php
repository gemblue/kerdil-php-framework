<?php

declare(strict_types=1);

namespace Core;

use function filter_var;

use const FILTER_SANITIZE_STRING;

/**
 * Request
 *
 * For handling http request, cleaning it with xss etc.
 */
class Request
{
    /**
     * Request::get
     *
     * Untuk mengambil query string dengan filtrasi
     */
    public function get(?string $key = null): string
    {
        $get = $this->clean($_GET);

        if ($key !== null) {
            return $get[$key];
        }

        return $get;
    }

    /**
     * Request::post
     *
     * Untuk mengambil POST dengan filtrasi
     *
     * @return mixed
     */
    public function post(?string $key = null)
    {
        $post = $this->clean($_POST);

        if ($key !== null) {
            return $post[$key];
        }

        return $post;
    }

    /**
     * Request::clean
     *
     * Cleaning all param.
     *
     * @param mixed $param
     *
     * @return mixed
     */
    private function clean($param)
    {
        foreach ($param as $key => $value) {
            $param[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        return $param;
    }
}
