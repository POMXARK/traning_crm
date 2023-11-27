<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'days_week';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table(self::TABLE)->insert([
                ['id' => '1', 'name' => 'Понедельник'],
                ['id' => '2', 'name' => 'Вторник'],
                ['id' => '3', 'name' => 'Среда'],
                ['id' => '4', 'name' => 'Четверг'],
                ['id' => '5', 'name' => 'Пятница'],
                ['id' => '6', 'name' => 'Суббота'],
                ['id' => '7', 'name' => 'Воскресенье'],
                ]
        );
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
