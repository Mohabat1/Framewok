<?php

namespace Somecode\Framework\Http;

class Request
{
    public function __construct(
        private readonly array $getParams,
        private readonly array $postData,
        private readonly array $files,
        private readonly array $server,
        private readonly array $cookies,
    ){
    }

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);

    }
    public function getPath(): string
{
    return strtok($this->server['REQUEST_URI'], '?');
}
public function getMethod(): string
{
    return $this->server['REQUEST_METHOD'];
}

}