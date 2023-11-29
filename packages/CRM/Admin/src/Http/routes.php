<?php

Route::group(['middleware' => ['web', 'admin_locale']], function () {

    Route::prefix(config('app.admin_path'))->group(function () {

        // Admin Routes
        Route::group(['middleware' => ['user']], function () {

            // Dashboard Route
            Route::get('statistics', 'CRM\Admin\Http\Controllers\Admin\StatisticController@index')->name('admin.statistics.index');

            Route::get('statistics_template', 'CRM\Admin\Http\Controllers\Admin\StatisticController@template')->name('admin.statistics.template');

            // API routes
            Route::group([
                'prefix'    => 'api',
            ], function () {
                Route::group([
                    'prefix'    => 'statistics',
                ], function () {
                    Route::get('/', 'CRM\Admin\Http\Controllers\Admin\StatisticController@getCardData')->name('admin.api.statistics.card.index');

                    Route::get('/cards', 'CRM\Admin\Http\Controllers\Admin\StatisticController@getCards')->name('admin.api.statistics.cards.index');

                    Route::post('/cards', 'CRM\Admin\Http\Controllers\Admin\StatisticController@updateCards')->name('admin.api.statistics.cards.update');

                    Route::post('/day', 'CRM\Admin\Http\Controllers\Admin\StatisticController@createDayStatistics')->name('admin.api.statistics.day.create');

                    Route::get('/calls_made_per_day', 'CRM\Admin\Http\Controllers\Admin\StatisticController@callsMadePerDay')->name('admin.api.statistics.calls_made_per_day');
                });
            });

            // Contacts Routes
            Route::group([
                'prefix'    => 'contacts',
                'namespace' => 'CRM\Admin\Http\Controllers\TrainingType'
            ], function () {
                // Customers Routes
                Route::prefix('training_types')->group(function () {
                    Route::get('', 'TrainingTypeController@index')->name('admin.training_types.index');

                    Route::get('create', 'TrainingTypeController@create')->name('admin.training_types.create');

                    Route::post('create', 'TrainingTypeController@store')->name('admin.training_types.store');

                    Route::get('edit/{id?}', 'TrainingTypeController@edit')->name('admin.training_types.edit');

                    Route::put('edit/{id}', 'TrainingTypeController@update')->name('admin.training_types.update');

                    Route::get('search', 'TrainingTypeController@search')->name('admin.training_types.search');

                    Route::delete('{id}', 'TrainingTypeController@destroy')->name('admin.training_types.delete');

                    Route::put('mass-destroy', 'TrainingTypeController@massDestroy')->name('admin.training_types.mass_delete');
                });
            });

            // Contacts Routes
            Route::group([
                'prefix'    => 'contacts',
                'namespace' => 'CRM\Admin\Http\Controllers\TrainingPlan'
            ], function () {
                // Customers Routes
                Route::prefix('training_plan')->group(function () {
                    Route::get('', 'TrainingPlanController@index')->name('admin.training_plan.index');

                    Route::get('create', 'TrainingPlanController@create')->name('admin.training_plan.create');

                    Route::post('create', 'TrainingPlanController@store')->name('admin.training_plan.store');

                    Route::get('view/{id?}', 'TrainingPlanController@view')->name('admin.training_plan.view');
                    Route::get('edit/{id?}', 'TrainingPlanController@edit')->name('admin.training_plan.edit');

                    Route::put('edit/{id}', 'TrainingPlanController@update')->name('admin.training_plan.update');

                    Route::get('search', 'TrainingPlanController@search')->name('admin.training_plan.search');

                    Route::delete('{id}', 'TrainingPlanController@destroy')->name('admin.training_plan.delete');

                    Route::put('mass-destroy', 'TrainingPlanController@massDestroy')->name('admin.training_plan.mass_delete');
                });
        });
        });
    });
});
