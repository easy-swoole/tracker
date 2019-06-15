<?php


namespace EasySwoole\Tracker\Shell;


use EasySwoole\Tracker\Shell\Response\ArpCache;
use EasySwoole\Tracker\Shell\Response\Bandwidth;
use EasySwoole\Tracker\Shell\Response\CommonApplications;
use EasySwoole\Tracker\Shell\Response\CpuIntensiveProcesses;
use EasySwoole\Tracker\Shell\Response\CronHistory;
use EasySwoole\Tracker\Shell\Response\CurrentRam;
use EasySwoole\Tracker\Shell\Response\DiskPartition;
use EasySwoole\Tracker\Shell\Response\GeneralInfo;
use EasySwoole\Tracker\Shell\Response\IoStats;
use EasySwoole\Tracker\Shell\Response\IpAddresses;
use EasySwoole\Tracker\Shell\Response\LoadAvg;
use EasySwoole\Tracker\Shell\Response\LoggedInUsers;
use EasySwoole\Tracker\Shell\Response\NetworkConnections;
use EasySwoole\Tracker\Shell\Response\Ping;
use EasySwoole\Tracker\Shell\Response\Pm2Stats;
use EasySwoole\Tracker\Shell\Response\RamIntensiveProcesses;
use EasySwoole\Tracker\Shell\Response\ScheduledCrons;
use EasySwoole\Tracker\Shell\Response\Swap;
use EasySwoole\Tracker\Shell\Response\CurrentUserAccounts;
use Swoole\Coroutine;

class Shell
{

    public static function arpCache()
    {
        $ret = [];
        $json = self::exec('arpCache.sh');
        foreach ($json as $item){
            $ret[] = new ArpCache($item);
        }
        return $ret;
    }

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

    public static function commonApplications()
    {
        $info = self::exec('commonApplications.sh');
        return new CommonApplications($info);
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

    public static function cpuUtilization()
    {
        $json = self::exec('cpuUtilization.sh');
        return $json;
    }

    public static function cronHistory()
    {
        $info = self::exec('cronHistory.sh');
        return new CronHistory($info);
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

    public static function dockerProcesses()
    {
        $info = self::exec('dockerProcesses.sh');
        return new CronHistory($info);
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

    public static function downloadTransferRate()
    {
        $json = self::exec('downloadTransferRate.sh');
        return $json;
    }

    public static function generalInfo()
    {
        $info = self::exec('generalInfo.sh');
        return new GeneralInfo($info);
    }

    public static function ioStats()
    {
        $info = self::exec('ioStats.sh');
        return new IoStats($info);
    }

    public static function ipAddresses()
    {
        $info = self::exec('ipAddresses.sh');
        return new IpAddresses($info);
    }

    public static function loadAvg()
    {
        $info = self::exec('loadAvg.sh');
        return new LoadAvg($info);
    }

    public static function loggedInUsers()
    {
        $info = self::exec('loggedInUsers.sh');
        return new LoggedInUsers($info);
    }

    public static function memcached()
    {
        return  self::exec('memcached.sh');
    }

    public static function memoryInfo()
    {
        return  self::exec('memoryInfo.sh');
    }

    public static function networkConnections()
    {
        $info = self::exec('networkConnections.sh');
        return new NetworkConnections($info);
    }

    public static function numberOfCpuCores()
    {
        return  self::exec('numberOfCpuCores.sh');
    }

    public static function ping()
    {
        $info = self::exec('ping.sh');
        return new Ping($info);
    }

    public static function pm2Stats()
    {
        $ret = [];
        $json = self::exec('pm2Stats.sh');
        foreach ($json as $item){
            $ret[] = new Pm2Stats($item);
        }
        return $ret;
    }

    public static function ramIntensiveProcesses()
    {
        $info = self::exec('ramIntensiveProcesses.sh');
        return new RamIntensiveProcesses($info);
    }

    public static function redis()
    {
        return  self::exec('redis.sh');
    }

    public static function scheduledCrons()
    {
        $ret = [];
        $json = self::exec('scheduledCrons.sh');
        foreach ($json as $item){
            $ret[] = new ScheduledCrons($item);
        }
        return $ret;
    }

    public static function swap()
    {
        $info = self::exec('swap.sh');
        return new Swap($info);
    }

    public static function uploadTransferRate()
    {
        return  self::exec('uploadTransferRate.sh');
    }

    public static function userAccounts()
    {
        $info = self::exec('userAccounts.sh');
        return new CurrentUserAccounts($info);
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