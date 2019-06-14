<?php


namespace EasySwoole\Tracker\Shell\Response;


use EasySwoole\Spl\SplBean;

class ScheduledCrons extends SplBean
{

    protected $min;
    protected $hrs;
    protected $day;
    protected $month;
    protected $wkday;
    protected $user;
    protected $cmd;

    /**
     * @return mixed
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param $min
     */
    public function setMin($min): void
    {
        $this->min = $min;
    }

    /**
     * @return mixed
     */
    public function getHrs()
    {
        return $this->hrs;
    }

    /**
     * @param $hrs
     */
    public function setHrs($hrs): void
    {
        $this->hrs = $hrs;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param $day
     */
    public function setDay($day): void
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param $month
     */
    public function setMonth($month): void
    {
        $this->month = $month;
    }

    /**
     * @return mixed
     */
    public function getWkday()
    {
        return $this->wkday;
    }

    /**
     * @param $wkday
     */
    public function setWkday($wkday): void
    {
        $this->wkday = $wkday;
    }

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
    public function getCmd()
    {
        return $this->cmd;
    }

    /**
     * @param mixed $cmd
     */
    public function setCmd($cmd): void
    {
        $this->cmd = $cmd;
    }
}
