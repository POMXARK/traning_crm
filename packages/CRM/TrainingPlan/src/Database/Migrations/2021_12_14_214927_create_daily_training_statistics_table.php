<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'daily_training_statistics';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name')->comment('Наименование');

            $table->UnsignedInteger('number_approaches')->comment('Количество подходов');

            $table->UnsignedInteger('number_repetitions')->comment('Количество повторений');

            $table->string('approach_time',5)->comment('Время подхода минуты:секунды');

            $table->string('pause_time',5)->comment('Время паузы минуты:секунды');

            $table->string('rest_between_approaches',5)->comment('Отдых между подходами минуты:секунды');

            $table->UnsignedInteger('completion_percentage')->comment('Процент выполнения');

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
