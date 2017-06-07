<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RotaSlotStaff extends Model
{
    protected $table = 'rota_slot_staff';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ignoredItems', function ($builder) {
            $builder->whereNotNull('staffid')
                ->where('slottype', 'shift');
        });
    }
}
