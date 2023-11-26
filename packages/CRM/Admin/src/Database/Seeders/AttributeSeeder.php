<?php

namespace CRM\Admin\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
    
        DB::table('attributes')->insert([
            [
            'id'              => '33',
            'code'            => 'title',
            'name'            => 'Название',
            'type'            => 'text',
            'entity_type'     => 'training_types',
            'lookup_type'     => NULL,
            'validation'      => NULL,
            'sort_order'      => '1',
            'is_required'     => '1',
            'is_unique'       => '1',
            'quick_add'       => '1',
            'is_user_defined' => '0',
            'created_at'      => $now,
            'updated_at'      => $now,
            ],
            [
            'id'              => '34',
            'code'            => 'description',
            'name'            => 'Описание',
            'type'            => 'textarea',
            'entity_type'     => 'training_types',
            'lookup_type'     => NULL,
            'validation'      => NULL,
            'sort_order'      => '1',
            'is_required'     => '1',
            'is_unique'       => '0',
            'quick_add'       => '1',
            'is_user_defined' => '0',
            'created_at'      => $now,
            'updated_at'      => $now,
            ],
            [
            'id'              => '35',
            'code'            => 'number_approaches',
            'name'            => 'Количество подходов',
            'type'            => 'text',
            'entity_type'     => 'training_types',
            'lookup_type'     => NULL,
            'validation'      => 'numeric',
            'sort_order'      => '5',
            'is_required'     => '1',
            'is_unique'       => '0',
            'quick_add'       => '1',
            'is_user_defined' => '0',
            'created_at'      => $now,
            'updated_at'      => $now,
            ],
            [
            'id'              => '36',
            'code'            => 'number_repetitions',
            'name'            => 'Количество повторений',
            'type'            => 'text',
            'entity_type'     => 'training_types',
            'lookup_type'     => NULL,
            'validation'      => 'numeric',
            'sort_order'      => '3',
            'is_required'     => '1',
            'is_unique'       => '0',
            'quick_add'       => '1',
            'is_user_defined' => '0',
            'created_at'      => $now,
            'updated_at'      => $now,
            ],
            [
            'id'              => '37',
            'code'            => 'approach_time',
            'name'            => 'Время подхода',
            'type'            => 'text',
            'entity_type'     => 'training_types',
            'lookup_type'     => NULL,
            'validation'      => NULL,
            'sort_order'      => '5',
            'is_required'     => '1',
            'is_unique'       => '0',
            'quick_add'       => '1',
            'is_user_defined' => '0',
            'created_at'      => $now,
            'updated_at'      => $now,
            ],
            [
            'id'              => '38',
            'code'            => 'pause_time',
            'name'            => 'Время паузы',
            'type'            => 'text',
            'entity_type'     => 'training_types',
            'lookup_type'     => NULL,
            'validation'      => NULL,
            'sort_order'      => '4',
            'is_required'     => '1',
            'is_unique'       => '0',
            'quick_add'       => '1',
            'is_user_defined' => '0',
            'created_at'      => $now,
            'updated_at'      => $now,
            ],

        ]);
    }
}