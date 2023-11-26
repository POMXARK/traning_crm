<?php

namespace CRM\Training\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \CRM\Training\Models\TrainingType::class,
    ];
}