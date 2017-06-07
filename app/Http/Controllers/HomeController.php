<?php

namespace App\Http\Controllers;

use App\RotaSlotStaff;
use Illuminate\View\View;
use App\ViewModels\EmployeesTableVM;
use App\Services\AloneTimeCalculator;

class HomeController extends Controller
{
    /**
     * @var AloneTimeCalculator
     */
    private $aloneTimeCalculator;

    /**
     * HomeController constructor.
     * @param AloneTimeCalculator $aloneTimeCalculator
     */
    public function __construct(AloneTimeCalculator $aloneTimeCalculator)
    {
        $this->aloneTimeCalculator = $aloneTimeCalculator;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        $slots = RotaSlotStaff::orderBy('staffid')
            ->get();

        $employees = new EmployeesTableVM();
        foreach ($slots as $slot) {
            $employees->addItem($slot->staffid, $slot->daynumber, $slot->workhours);
        }

        $aloneTimes = [];
        for ($day = 0; $day < 7; $day++) {
            $aloneTimes[$day] = $this->aloneTimeCalculator->computeForDay($slots->where('daynumber', $day));
        }

        return view('home', [
            'employees' => $employees,
            'aloneTimes' => $aloneTimes
        ]);
    }
}
