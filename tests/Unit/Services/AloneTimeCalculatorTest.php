<?php

namespace Tests\Unit\Services;

use App\RotaSlotStaff;
use App\Services\AloneTimeCalculator;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class AloneTimeCalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp()
    {
        parent::setUp();

        $this->calculator = new AloneTimeCalculator();
    }

    /**
     * @test
     */
    public function when_one_person_at_work_alone_time_should_be_worked_hours()
    {
        $data = new Collection();

        $slot = $this->createSlot('08:00', '09:00');
        $data->push($slot);

        $minutesAlone = $this->calculator->computeForDay($data);

        $this->assertEquals(60, $minutesAlone);
    }

    /**
     * @test
     */
    public function multiple_employees_arrive_and_leave_before_the_first_one()
    {
        $data = new Collection();

        $data->push($this->createSlot('08:00', '18:00'));
        $data->push($this->createSlot('10:00', '14:00'));
        $data->push($this->createSlot('09:00', '15:00'));

        $minutesAlone = $this->calculator->computeForDay($data);

        $this->assertEquals(240, $minutesAlone);
    }

    private function createSlot($startTime, $endTime)
    {
        $slot =  new RotaSlotStaff();
        $slot->starttime = $startTime;
        $slot->endtime = $endTime;
        return $slot;
    }
}
