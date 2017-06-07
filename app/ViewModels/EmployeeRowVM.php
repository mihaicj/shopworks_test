<?php

namespace App\ViewModels;

class EmployeeRowVM {
    private $cells = [];

    function __construct()
    {
        $this->cells = array_fill(0, 7, 0);
    }

    public function addDayHours($dayNumber, $hours)
    {
        $this->cells[$dayNumber] = $hours;
    }

    /**
     * @return array
     */
    public function getCells()
    {
        return $this->cells;
    }

    public function getForDay($dayNumber)
    {
        return $this->cells[$dayNumber];
    }
}