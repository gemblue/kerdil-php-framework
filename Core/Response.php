<?php

declare(strict_types=1);

namespace Core;

use function header;
use function json_encode;

/**
 * Response
 *
 * For handling http response.
 */
class Response
{
    /** @var headers */
    public $headers = [];

    /**
     * Response::SetHeader
     */
    public function setHeader(string $header): Response
    {
        $this->headers[] = $header;

        return $this;
    }

    /**
     * Response::ShowJSON
     */
    public function showJSON(mixed $data): void
    {
        foreach ($this->headers as $header) {
            header($header);
        }

        echo json_encode($data);
    }
}
