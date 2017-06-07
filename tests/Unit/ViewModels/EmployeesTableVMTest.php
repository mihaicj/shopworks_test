<?php

namespace Tests\Unit\ViewModels;

use Tests\TestCase;
use App\ViewModels\EmployeesTableVM;

class EmployeesTableVMTest extends TestCase
{
    /**
     * @var EmployeesTableVM
     */
    private $employeesTable;

    protected function setUp()
    {
        parent::setUp();

        $this->employeesTable = new EmployeesTableVM();
    }

    /**
     * @test
     */
    public function table_should_calculate_total_hours_for_a_day()
    {
        $day = 1;

        $this->employeesTable->addItem(1, $day, 10);
        $this->employeesTable->addItem(2, $day, 10);
        $this->employeesTable->addItem(3, $day, 10);

        $totalHours = $this->employeesTable->getTotalForDay($day);

        $this->assertEquals(30, $totalHours);
    }
}
