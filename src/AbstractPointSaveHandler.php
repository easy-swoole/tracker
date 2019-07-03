<?php


namespace EasySwoole\Tracker;


abstract class AbstractPointSaveHandler
{
    abstract function save(Point $point):bool ;
    /*
     * 采样率，百分比
     */
    function probability():int
    {
        return 50;
    }
}