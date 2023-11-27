<?php

namespace CRM\TrainingPlan\Repositories;

use Webkul\Core\Eloquent\Repository;

class DaysWeekRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'CRM\TrainingPlan\Contracts\DaysWeek';
    }
}
