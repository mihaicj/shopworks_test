<?php
namespace App\Services;

use Carbon\Carbon;

class TimeEntry
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var Carbon
     */
    private $time;

    /**
     * TimeEntry constructor.
     * @param string $type
     * @param Carbon $time
     */
    public function __construct($type, Carbon $time)
    {
        $this->type = $type;
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Carbon
     */
    public function getTime()
    {
        return $this->time;
    }
}