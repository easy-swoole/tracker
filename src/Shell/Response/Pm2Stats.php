<?php


namespace EasySwoole\Tracker\Shell\Response;


use EasySwoole\Spl\SplBean;

class Pm2Stats extends SplBean
{
    protected $appName;
    protected $id;
    protected $mode;
    protected $pid;
    protected $status;
    protected $restart;
    protected $uptime;
    protected $memory;
    protected $watching;

    /**
     * @return mixed
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * @param mixed $appName
     */
    public function setAppName($appName): void
    {
        $this->appName = $appName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     */
    public function setMode($mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param $pid
     */
    public function setPid($pid): void
    {
        $this->pid = $pid;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getRestart()
    {
        return $this->restart;
    }

    /**
     * @param $restart
     */
    public function setRestart($restart): void
    {
        $this->restart = $restart;
    }

    /**
     * @return mixed
     */
    public function getUptime()
    {
        return $this->uptime;
    }

    /**
     * @param $uptime
     */
    public function setUptime($uptime): void
    {
        $this->uptime = $uptime;
    }

    /**
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param $memory
     */
    public function setMemory($memory): void
    {
        $this->memory = $memory;
    }

    /**
     * @return mixed
     */
    public function getWatching()
    {
        return $this->watching;
    }

    /**
     * @param $watching
     */
    public function setWatching($watching): void
    {
        $this->watching = $watching;
    }
}
