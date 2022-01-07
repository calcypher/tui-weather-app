<?php

namespace App\Dto;

class Weather
{
    /**
     * @var string
     */
    private $day;
    /**
     * @var string
     */
    private $condition;

    /**
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param string $day
     *
     * @return void
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @param string $condition
     *
     * @return void
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }
}
