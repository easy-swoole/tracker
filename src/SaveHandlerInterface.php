<?php


namespace EasySwoole\Tracker;


interface SaveHandlerInterface
{
    function save(?Point $point,?array $globalArg = []):bool ;
}