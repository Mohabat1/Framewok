<?php

use App\Controllers\HomeController;
use Somecode\Framework\Routing\Route;


return[
    //get
    Route::get ('/', [HomeController::class, 'index']),


];