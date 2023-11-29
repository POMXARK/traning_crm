<?php

namespace CRM\TrainingPlan\Models;

use Illuminate\Database\Eloquent\Model;
use CRM\TrainingPlan\Contracts\DailyTrainingStatistics as  DailyTrainingStatisticsContract;

class DailyTrainingStatistics extends Model implements  DailyTrainingStatisticsContract
{
    protected $table = 'daily_training_statistics';

    protected $casts = [
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['entity_type', 'id'];

}
