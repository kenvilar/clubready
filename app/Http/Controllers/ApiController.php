<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;

class ApiController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        //if you want to enable this, change the middleware to api from mapApiRoutes() in app/Providers/RouteServiceProvider.php
        //$this->middleware('auth:api');
    }
}
