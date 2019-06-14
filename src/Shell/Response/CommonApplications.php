<?php


namespace EasySwoole\Tracker\Shell\Response;


use EasySwoole\Spl\SplBean;

class CommonApplications extends SplBean
{
    protected $binary;
    protected $location;
    protected $installed;

    /**
     * @return mixed
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * @param $binary
     */
    public function setBinary($binary): void
    {
        $this->binary = $binary;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getInstalled()
    {
        return $this->installed;
    }

    /**
     * @param $installed
     */
    public function setInstalled($installed): void
    {
        $this->installed = $installed;
    }
}