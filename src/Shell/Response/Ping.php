<?php


namespace EasySwoole\Tracker\Shell\Response;


use EasySwoole\Spl\SplBean;

class Ping extends SplBean
{
    protected $host;
    protected $ping;

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getPing()
    {
        return $this->ping;
    }

    /**
     * @param mixed $ping
     */
    public function setPing($ping): void
    {
        $this->ping = $ping;
    }
}
