<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $defaultPaginate;
    function __construct()
    {
        $this->defaultPaginate = env('PAGINATE_DEFAULT');
    }
}
