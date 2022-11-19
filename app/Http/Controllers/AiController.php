<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiController extends Controller
{
    public function index()
    {
        return view('pages.ai_searching');
    }

    public function result()
    {
        return view('pages.ai_searching')->with('message', 'hello');
    }
}
