<?php


namespace EasySwoole\Tracker\Shell;


use EasySwoole\Tracker\Shell\Response\Bandwidth;
use EasySwoole\Tracker\Shell\Response\CpuIntensiveProcesses;
use EasySwoole\Tracker\Shell\Response\CurrentRam;
use EasySwoole\Tracker\Shell\Response\DiskPartition;
use Swoole\Coroutine;

class Shell
{
    /*
     * 获取带宽信息
     */
    public static function bandWidth():array
    {
        $ret = [];
        $json = self::exec('bandwidth.sh');
        foreach ($json as $item){
            $ret[] = new Bandwidth($item);
        }
        return $ret;
    }

    public static function cpuIntensiveProcesses()
    {
        $json = self::exec('cpuIntensiveProcesses.sh');
        $ret = [];
        foreach ($json as $item){
            $ret[] = new CpuIntensiveProcesses($item);
        }
        return $ret;
    }

    public static function cpuTemp()
    {
        $json = self::exec('cpuTemp.sh');
        return $json;
    }

    public static function diskPartitions()
    {
        $json = self::exec('diskPartitions.sh');
        $ret = [];
        foreach ($json as $item){
            $ret[] = new DiskPartition($item);
        }
        return $ret;
    }

    public static function currentRam()
    {
        $info = self::exec('currentRam.sh');
        return new CurrentRam($info);
    }


    public static function cupInfo():array
    {
        return self::exec('cpuInfo.sh');
    }

    private static function exec($file):array
    {
        try{
            $js = trim(Coroutine::exec(__DIR__."/{$file}")['output']);
            $js = json_decode($js,true);
            if(is_array($js)){
                return $js;
            }
        }catch (\Throwable $throwable){

        }
        return [];
    }
}