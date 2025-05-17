<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mail extends Model
{
    use SoftDeletes;

    protected $table = 'mails';

    protected $fillable = ['date', 'name', 'email', 'message', 'status'];

    /**
     * Scope a query to only include mails of a given status.
     * 
     * @param Builder $query
     * @param string $status
     * @return void
     */
    #[Scope]
    public function scopeOfStatus(Builder $query, string $status = ''): Builder
    {
        // If there is no type passed, return all projects.
        if ($status == '') {
            return $query;
        }

        // Return projects of type = $type.
        return $query->where("status", $status);
    }
}
