<?php


namespace EasySwoole\Tracker\Http\Controller;


use EasySwoole\Http\AbstractInterface\Controller;

class Api extends Controller
{

    function index()
    {
        $this->response()->write('api');
    }
}