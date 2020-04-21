<?php


namespace EasySwoole\Tracker;


use EasySwoole\Component\Singleton;
use EasySwoole\Tracker\Excetion\Exception;
use Swoole\Coroutine;

class PointContext
{
    use Singleton;

    protected $deferList = [];
    protected $pointStack = [];
    protected $currentPointStack = [];
    /** @var SaveHandlerInterface */
    protected $saveHandler;
    protected $autoSave = false;
    protected $globalArg = [];

    function setGlobalArg(array $data,?int $cid = null):PointContext
    {
        if($cid === null){
            $cid = $this->cid();
        }
        $this->globalArg[$cid] = $data;
        return $this;
    }

    function getGlobalArg(?int $cid = null):?array
    {
        if($cid === null){
            $cid = $this->cid();
        }
        if(isset($this->globalArg[$cid])){
            return $this->globalArg[$cid];
        }else{
            return null;
        }
    }

    function setSaveHandler(SaveHandlerInterface $handler):PointContext
    {

        $this->saveHandler = $handler;
        return $this;
    }

    function enableAutoSave():PointContext
    {
        $this->autoSave = true;
        return $this;
    }

    public function createStart(string $name, ?int $cid = null):Point
    {
        if($cid === null){
            $cid = $this->cid();
        }
        if(!isset($this->pointStack[$cid])){
            $this->pointStack[$cid] = new Point($name);
            $this->currentPointStack[$cid] = $this->pointStack[$cid];
            return $this->pointStack[$cid];
        }else{
            throw new Exception("start point has already created");
        }
    }

    public function current(?int $cid = null):?Point
    {
        if($cid === null){
            $cid = $this->cid();
        }
        if(isset($this->currentPointStack[$cid])){
            return $this->currentPointStack[$cid];
        }else{
           return null;
        }
    }

    public function startPoint(?int $cid = null):?Point
    {
        if($cid === null){
            $cid = $this->cid();
        }
        if(isset($this->pointStack[$cid])){
            return $this->pointStack[$cid];
        }else{
            return null;
        }
    }

    public function next(string $name, ?int $cid = null):Point
    {
        $current = $this->current($cid);
        /*
         * 自动创建
         */
        if($current){
            if($cid === null){
                $cid = $this->cid();
            }
            $point = $current->next($name);
            $this->currentPointStack[$cid] = $point;
            return $point;
        }else{
            throw new Exception("current point is null,please create start point");
        }
    }

    public function find(string $name,?int $cid = null):?Point
    {
        $start = $this->startPoint($cid);
        if($start){
            return $start->find($name);
        }else{
            throw new Exception("start point is null,please create start point");
        }
    }

    public function findChild(string $name,?int $cid = null):?Point
    {
        $start = $this->startPoint($cid);
        if($start){
            return $start->findChild($name);
        }else{
            throw new Exception("start point is null,please create start point");
        }
    }

    public function appendChild(string $name, ?int $cid = null)
    {
        $current = $this->current($cid);
        if(!$current){
            /*
             * 需要先创建开头节点
             */
            throw new Exception("current point is empty");
        }else{
            return $current->appendChild($name);
        }
    }

    private function cid():int
    {
        $cid = Coroutine::getUid();
        if(!isset($this->deferList[$cid]) && $cid > 0){
            $this->deferList[$cid] = true;
            defer(function ()use($cid){
                if($this->autoSave && $this->saveHandler){
                    $this->save();
                }
                unset($this->deferList[$cid]);
                if(isset($this->currentPointStack[$cid])){
                    unset($this->currentPointStack[$cid]);
                }
                if(isset($this->pointStack[$cid])){
                    unset($this->pointStack[$cid]);
                }
                if(isset($this->globalArg[$cid])){
                    unset($this->globalArg[$cid]);
                }
            });
        }
        return $cid;
    }

    function save(Point $point = null):?bool
    {
        if($point == null){
            $point = $this->current();
        }
        if($point){
            $point->recursive(function (Point $point){
                $point->end(Point::END_BY_AUTO);
            });
            if($this->saveHandler){
                return $this->saveHandler->save($point,$this->getGlobalArg());
            }
        }
        return null;
    }
}
