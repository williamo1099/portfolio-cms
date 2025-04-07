<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = ['type', 'title', 'description', 'stacks', 'image_path'];

    public function scopeOfType($query, $type = '')
    {
        // If there is no type passed, return all projects.
        if ($type == '') {
            return $query;
        }

        // Return projects of type = $type.
        return $query->whereType($type);
    }
}
