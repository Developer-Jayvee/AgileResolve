<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TicketAssignee extends Model
{
    protected $table = "ticket_assignee";

    protected $fillable = [
      'ticket_id' , 'user_id' , 'order'
    ];

    public function users(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
