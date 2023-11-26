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

// Dashboard > Training > Training Types > Edit
Breadcrumbs::for('training.training_types.edit', function (BreadcrumbTrail $trail, $training_type) {
    $trail->parent('training.training_types');
    $trail->push(trans('admin::app.contacts.persons.edit-title'), route('admin.training_types.edit', $training_type->id));
});