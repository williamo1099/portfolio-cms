<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    protected $table = 'curriculum_vitaes';

    protected $fillable = ['path'];
}
