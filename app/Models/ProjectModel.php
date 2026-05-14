<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class ProjectModel extends Model
{
    protected $table = "projects";

    protected $fillable = [
        'code','title','client_id','manager_id'
    ];

    protected static function booted()
    {
        static::creating(function( $project) {
            $project->code = 'PR-'. strtoupper(Str::random(10));
        });
    }

}
