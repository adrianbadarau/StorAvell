<?php

namespace StorAvell\Http\Controllers;

use Illuminate\Http\Request;
use StorAvell\Http\Requests;

class AngularController extends Controller
{
    public function serveApp()
    {
        return view('templating::index');
    }

    public function unsupported()
    {
        return view('unsupported_browser');
    }
}
