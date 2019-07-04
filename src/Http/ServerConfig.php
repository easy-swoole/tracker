<?php


namespace EasySwoole\Tracker\Http;


class ServerConfig
{
    protected $port = 9502;
    protected $listenAddress = '0.0.0.0';
    protected $controllerNamaSpace = 'EasySwoole\\Tracker\\Http\\Controller\\';

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getListenAddress(): string
    {
        return $this->listenAddress;
    }

    /**
     * @param string $listenAddress
     */
    public function setListenAddress(string $listenAddress): void
    {
        $this->listenAddress = $listenAddress;
    }

    /**
     * @return string
     */
    public function getControllerNamaSpace(): string
    {
        return $this->controllerNamaSpace;
    }

    /**
     * @param string $controllerNamaSpace
     */
    public function setControllerNamaSpace(string $controllerNamaSpace): void
    {
        $this->controllerNamaSpace = $controllerNamaSpace;
    }

}