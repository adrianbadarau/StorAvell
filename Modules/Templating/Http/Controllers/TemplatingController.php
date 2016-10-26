<?php

namespace Modules\Templating\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class TemplatingController extends Controller
{
    public function frontEnd()
    {
        return view("templating::index");
    }

    public function admin()
    {
        return view("templating::admin.index");
    }
}
