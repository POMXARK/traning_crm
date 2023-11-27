<?php

namespace CRM\TrainingPlan\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \CRM\TrainingPlan\Models\TrainingPlan::class,
        \CRM\TrainingPlan\Models\DaysWeek::class,
    ];
}
