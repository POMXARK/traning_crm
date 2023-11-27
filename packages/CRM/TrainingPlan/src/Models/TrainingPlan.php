<?php

namespace CRM\TrainingPlan\Models;

use CRM\Training\Models\TrainingTypeProxy;
use Illuminate\Database\Eloquent\Model;
use CRM\TrainingPlan\Contracts\TrainingPlan as TrainingPlanContract;

class TrainingPlan extends Model implements TrainingPlanContract
{
    protected $table = 'training_plan';

    protected $casts = [
//        'time' => 'array',
//        'training_types_id' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['entity_type'];

    public function trainingType()
    {
        return $this->belongsTo(TrainingTypeProxy::modelClass(), 'training_types_id');
    }
}
