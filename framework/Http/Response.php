<?php

namespace Somecode\Framework\Http;

class Response
{
    public function __construct(
        private mixed $content,
        private mixed $statusCode = 200,
        private mixed $headers = [],
    ){

    }
    public function send()
    {
        echo $this->content;
    }

}