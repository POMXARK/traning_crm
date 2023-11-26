<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'training_types';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->comment('Наименование');

            $table->text('description')->nullable()->comment('Описание');

            $table->UnsignedInteger('number_approaches')->comment('Количество подходов');

            $table->UnsignedInteger('number_repetitions')->comment('Количество повторений');

            $table->string('approach_time',5)->comment('Время подхода минуты:секунды');

            $table->string('pause_time',5)->comment('Время паузы минуты:секунды');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
};
