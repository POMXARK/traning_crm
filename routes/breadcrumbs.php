<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

include base_path('routes/krayin_breadcrumbs.php');

// Dashboard > Training > Training Types
Breadcrumbs::for('training.training_types', function (BreadcrumbTrail $trail) {
    $trail->parent('contacts');
    $trail->push(trans('admin::app.layouts.training_types'), route('admin.training_types.index'));
});

// Dashboard > Training > Training Types > Create
Breadcrumbs::for('training.training_types.create', function (BreadcrumbTrail $trail) {
    $trail->parent('training.training_types');
    $trail->push(trans('admin::app.training.training_types.create-title'), route('admin.training_types.create'));
});

// Dashboard > Training > Training Plan > Edit
Breadcrumbs::for('training.training_types.edit', function (BreadcrumbTrail $trail, $training_types) {
    $trail->parent('training.training_types');
    $trail->push(trans('admin::app.training.training_types.edit-title'), route('admin.training_types.edit', $training_types->id));
});


// Dashboard > Training > Training Plan
Breadcrumbs::for('training.training_plan', function (BreadcrumbTrail $trail) {
    $trail->parent('contacts');
    $trail->push(trans('admin::app.layouts.training_plan'), route('admin.training_plan.index'));
});

// Dashboard > Training > Training Plan > Create
Breadcrumbs::for('training.training_plan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('training.training_plan');
    $trail->push(trans('admin::app.training.training_plan.create-title'), route('admin.training_plan.create'));
});

// Dashboard > Training > Training Plan > Edit
Breadcrumbs::for('training.training_plan.edit', function (BreadcrumbTrail $trail, $training_plan) {
    $trail->parent('training.training_plan');
    $trail->push(trans('admin::app.training.training_plan.edit-title'), route('admin.training_plan.edit', $training_plan->id));
});