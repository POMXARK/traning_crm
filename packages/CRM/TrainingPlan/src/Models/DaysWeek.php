<?php

namespace CRM\TrainingPlan\Models;

use Illuminate\Database\Eloquent\Model;
use CRM\TrainingPlan\Contracts\DaysWeek as DaysWeekContract;

class DaysWeek extends Model implements DaysWeekContract
{
    public $timestamps = false;
    
    protected $table = 'days_week';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'name'
    ];
}
