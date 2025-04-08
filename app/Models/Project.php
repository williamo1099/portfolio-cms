<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = ['type', 'title', 'description', 'stacks', 'image_path', 'is_active'];

    /**
     * Convert stacks attribute to an array.
     */
    protected function stacksArray(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value, array $attributes) => json_decode($attributes["stacks"] ?? [], true),
        );
    }

    /**
     * Scope a query to only include projects of a given type.
     */
    #[Scope]
    protected function ofType(Builder $query, string $type = ''): void
    {
        // If there is no type passed, return all projects.
        if ($type == '') {
            return;
        }

        // Return projects of type = $type.
        $query->whereType($type);
    }
}
