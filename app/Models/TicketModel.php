<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Override;

class TicketModel extends Model
{
    protected $table = "tickets";

    protected $fillable = [
        'code' , 'title' , 'content' , 'deadline' , 'projects_id' ,'created_by' , 'status' , 'receive_by' , 'updated_by'
    ];

    #[Override]
    protected static function booted()
    {
        static::creating(function ($ticket) {
            $ticket->code = 'TK-'. strtoupper(Str::random(10));
        });
    }
}
