<?php


namespace EasySwoole\Tracker\Shell\Response;


use EasySwoole\Spl\SplBean;

class LoggedInUsers extends SplBean
{
    protected $user;
    protected $from;
    protected $when;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from): void
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getWhen()
    {
        return $this->when;
    }

    /**
     * @param mixed $when
     */
    public function setWhen($when): void
    {
        $this->when = $when;
    }
}
