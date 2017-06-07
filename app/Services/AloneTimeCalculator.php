<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AloneTimeCalculator
{
    /**
     * @param Collection $data
     * @return int
     */
    public function computeForDay($data)
    {
        // Extract slots as simple IN OUT time entries
        $times = $this->convertToTimeEntries($data);

        // Sort entries by time
        $entries = $times->sortBy(function ($entry) {
            return $entry->getTime();
        });

        /** @var $lastEntry TimeEntry */
        $lastEntry = null;
        $nrOfEmployees = 0;
        $minutesAlone = 0;

        /** @var $entry TimeEntry */
        foreach ($entries as $entry) {
            // If only one employee was at work before this entry, count it as alone time
            // Time before the last entry is counted
            if ($nrOfEmployees === 1) {
                $minutesAlone += $lastEntry->getTime()->diffInMinutes($entry->getTime());
            }
            $entry->getType() === 'IN' ? $nrOfEmployees++ : $nrOfEmployees--;
            $lastEntry = $entry;
        }

        return $minutesAlone;
    }

    /**
     * @param $slot
     */
    private function convertToCarbon($slot)
    {
        $slot->starttime = new Carbon($slot->starttime);
        $slot->endtime = new Carbon($slot->endtime);

        if ($slot->starttime > $slot->endtime) {
            $slot->endtime->addDay();
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    private function convertToTimeEntries($data)
    {
        $times = $data->reduce(function ($carry, $item) {
            $this->convertToCarbon($item);

            $carry->push(new TimeEntry('IN', $item->starttime));
            $carry->push(new TimeEntry('OUT', $item->endtime));

            return $carry;
        }, new Collection());
        return $times;
    }
}