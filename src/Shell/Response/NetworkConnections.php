<?php


namespace EasySwoole\Tracker\Shell\Response;


use EasySwoole\Spl\SplBean;

class NetworkConnections extends SplBean
{
    protected $connections;
    protected $address;

    /**
     * @return mixed
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * @param mixed $connections
     */
    public function setConnections($connections): void
    {
        $this->connections = $connections;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }
}
