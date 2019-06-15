<?php


namespace EasySwoole\Tracker\Web;


use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Tracker\Shell\Shell;

class TrackerController extends Controller
{

    function index()
    {
        $this->actionNotFound('index');
    }

    function actionNotFound(?string $action)
    {
        $ref = new \ReflectionClass(Shell::class);
        if($ref->hasMethod($action)){
            $ret = Shell::$action();
            $this->writeJson(200,$ret);
        }else{
            $this->writeJson(404,null,"method {$action} not support");
        }
    }
}