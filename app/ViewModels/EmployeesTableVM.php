<?php

namespace App\ViewModels;

class EmployeesTableVM {
    private $rows = [];

    public function addItem($employeeId, $dayNumber, $hours)
    {
        if (!isset($this->rows[$employeeId])) {
            $this->rows[$employeeId] = new EmployeeRowVM();
        }
        $row = $this->rows[$employeeId];

        $row->addDayHours($dayNumber, $hours);
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    public function getTotalForDay($dayNumber)
    {
        return array_reduce($this->rows, function ($sum, $row) use ($dayNumber) {
            return $sum + $row->getForDay($dayNumber);
        }, 0);
    }
}