<?php

namespace CRM\TrainingPlan\Repositories;

use Webkul\Core\Eloquent\Repository;

class DailyTrainingStatisticsRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'CRM\TrainingPlan\Contracts\DailyTrainingStatistics';
    }
}