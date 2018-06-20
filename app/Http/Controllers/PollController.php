<?php

namespace quickpoll\Http\Controllers;

use Illuminate\Http\Request;

class PollController extends Controller
{
    //
    public function index(){
        return view("index");
    }
}
