<?php

namespace Tests\Unit\ViewModels;

use Tests\TestCase;
use App\ViewModels\EmployeeRowVM;

class EmployeeRowVMTest extends TestCase
{
    /**
     * @var EmployeeRowVM
     */
    private $employeeRow;

    protected function setUp()
    {
        parent::setUp();

        $this->employeeRow = new EmployeeRowVM();
    }

    /**
     * @test
     */
    public function initial_hours_should_be_0()
    {
        $hours = $this->employeeRow->getForDay(0);

        $this->assertEquals(0, $hours);
    }

    /**
     * @test
     */
    public function after_adding_hours_to_day_cell_should_have_new_hours()
    {
        $day = 5;
        $hours = 10;
        $this->employeeRow->addDayHours($day, $hours);
        $cellHours = $this->employeeRow->getForDay($day);

        $this->assertEquals($hours, $cellHours);
    }
}
