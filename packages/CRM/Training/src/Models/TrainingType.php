<?php

namespace CRM\Training\Models;

use Illuminate\Database\Eloquent\Model;
use CRM\Training\Contracts\TrainingType as TrainingTypeContract;

class TrainingType extends Model implements TrainingTypeContract
{
    protected $table = 'training_types';

    protected $casts = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['entity_type'];

}
