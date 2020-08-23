<?php

declare(strict_types=1);

namespace Samples\Controllers;

class Trial
{
    public function __construct()
    {
        echo 'Trial was instantiated .. <br/>';
    }

    public function index(): void
    {
        echo 'Trial index ..';
    }

    public function about(): void
    {
        echo 'Trial about ..';
    }
}
