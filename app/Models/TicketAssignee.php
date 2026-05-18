<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAssignee extends Model
{
    protected $table = "ticket_assignee";

    protected $fillable = [
      'ticket_id' , 'user_id' , 'order'
    ];
}
