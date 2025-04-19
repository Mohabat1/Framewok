<?php

define('BASE_PATH', dirname(__DIR__));

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;



$request = Request::createFromGlobals();

$content = "Hello World!";

$kernel = new Kernel();
$response = $kernel->handle($request);

$response->send();