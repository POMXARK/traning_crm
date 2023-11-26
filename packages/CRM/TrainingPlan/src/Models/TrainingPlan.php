<?php

namespace CRM\TrainingPlan\Models;

use Illuminate\Database\Eloquent\Model;
use CRM\TrainingPlan\Contracts\TrainingPlan as TrainingPlanContract;

class TrainingPlan extends Model implements TrainingPlanContract
{
    protected $table = 'training_plan';

    protected $casts = [
//        'training_types_id' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['entity_type'];

}
