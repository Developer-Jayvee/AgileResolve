<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Override;

class RoleModel extends Model
{
    protected $table ="roles";

    protected $fillable = [
        'code' ,'title'
    ];

    #[Override]
    protected static function booted()
    {
        static::creating(function ($role) {
            $role->code = 'R-'. strtoupper(Str::random(10));
        });
    }
}
