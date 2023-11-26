<?php

Route::group(['middleware' => ['web', 'admin_locale']], function () {

    Route::prefix(config('app.admin_path'))->group(function () {

        // Admin Routes
        Route::group(['middleware' => ['user']], function () {

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
        });
    });
});
