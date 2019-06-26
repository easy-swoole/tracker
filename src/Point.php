<?php


namespace EasySwoole\Tracker;


use EasySwoole\Utility\Random;

class Point
{
    const END_SUCCESS = 'success';
    const END_FAIL = 'fail';
    const END_UNKNOWN = 'unknown';

    protected $startTime;
    protected $startArg;
    protected $endTime;
    protected $pointName;
    protected $file;
    protected $line;
    protected $endStatus = self::END_UNKNOWN;
    protected $endArg;
    protected $pointId;
    protected $subPoints = [];
    protected $nextPoint;
    protected $depth = 0;

    function __construct(string $pointName = 'UNKNOWN',$depth = 0,$isNext = false)
    {
        $this->pointName = $pointName;
        $this->depth = $depth;
        $this->startTime = round(microtime(true),4);
        $debugTrace = debug_backtrace();
        if($isNext){
            $caller = $debugTrace[$depth + 1];
        }else{
            $caller = $debugTrace[$depth];
        }
        $this->file = $caller['file'];
        $this->line = $caller['line'];
        $this->pointId = Random::character(18);
    }


    function depth():int
    {
        return $this->depth;
    }

    function next(string $pointName = 'UNKNOWN'):Point
    {
        if(!isset($this->nextPoint)){
            $this->nextPoint = new Point($pointName,$this->depth,true);
        }
        return $this->nextPoint;
    }

    function hasNextPoint():?Point
    {
        return $this->nextPoint;
    }

    function appendChild(string $pointName = 'UNKNOWN')
    {
        $point = new Point($pointName,$this->depth+1);
        $this->subPoints[] = $point;
        return $point;
    }

    function appendChileInstance(Point $point)
    {
        $this->subPoints[] = $point;
    }

    function findChild(string $pointId):?Point
    {
        /** @var Point $point */
        foreach ($this->subPoints as $point){
            if($point->pointId() === $pointId){
                return $point;
            }
        }
        return null;
    }

    function children()
    {
        return $this->subPoints;
    }

    function pointId()
    {
        return $this->pointId;
    }

    function end(string $status = self::END_SUCCESS,$arg = null)
    {
        if($this->endStatus != self::END_UNKNOWN){
           return;
        }
        $this->endStatus = $status;
        $this->endArg = $arg;
        $this->endTime = round(microtime(true),4);
    }

    /**
     * @return float
     */
    public function getStartTime(): float
    {
        return $this->startTime;
    }

    /**
     * @param float $startTime
     */
    public function setStartTime(float $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getStartArg()
    {
        return $this->startArg;
    }

    /**
     * @param mixed $startArg
     */
    public function setStartArg($startArg): void
    {
        $this->startArg = $startArg;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return string
     */
    public function getPointName(): string
    {
        return $this->pointName;
    }

    /**
     * @param string $pointName
     */
    public function setPointName(string $pointName): void
    {
        $this->pointName = $pointName;
    }

    /**
     * @return string
     */
    public function getEndStatus(): string
    {
        return $this->endStatus;
    }

    /**
     * @param string $endStatus
     */
    public function setEndStatus(string $endStatus): void
    {
        $this->endStatus = $endStatus;
    }

    /**
     * @return mixed
     */
    public function getEndArg()
    {
        return $this->endArg;
    }

    /**
     * @param mixed $endArg
     */
    public function setEndArg($endArg): void
    {
        $this->endArg = $endArg;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param mixed $line
     */
    public function setLine($line): void
    {
        $this->line = $line;
    }

    public static function toString(Point $point,$depth = 0)
    {
        $string = '';
        $string .= str_repeat("\t",$depth)."#\n";
        $string .= str_repeat("\t",$depth)."PointName:{$point->getPointName()}\n";
        $string .= str_repeat("\t",$depth)."Status:{$point->getEndStatus()}\n";
        $string .= str_repeat("\t",$depth)."PointId:{$point->pointId()}\n";
        $string .= str_repeat("\t",$depth)."Depth:{$point->depth()}\n";
        $string .= str_repeat("\t",$depth)."Start:{$point->getStartTime()}\n";
        $string .= str_repeat("\t",$depth)."StartArg:".(self::argToString($point->getStartArg()))."\n";
        $string .= str_repeat("\t",$depth)."End:{$point->getEndTime()}\n";
        $string .= str_repeat("\t",$depth)."EndArg:".(self::argToString($point->getEndArg()))."\n";
        $string .= str_repeat("\t",$depth)."ChildCount:".(count($point->children()))."\n";
        if(!empty($point->children())){
            $string .= str_repeat("\t",$depth)."Children:\n";
            $children = $point->children();
            foreach ($children as $child){
                $string .= self::toString($child,$depth+1);
            }
        }else{
            $string .= str_repeat("\t",$depth)."Children:None\n";
        }

        if($point->hasNextPoint()){
            $string .= str_repeat("\t",$depth)."NextPoint:\n";
            $string .= self::toString($point->hasNextPoint());
        }else{
            $string .= str_repeat("\t",$depth)."NextPoint:None\n";
        }
        return $string;
    }

    private static function argToString($arg)
    {
        if($arg == null){
            return 'null';
        }else if(is_array($arg)){
            return json_encode($arg,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        }else{
            return (string)$arg;
        }
    }
}