<?php

namespace App\Enums;

enum TicketStatus : string
{
    case ACCEPTED = "accepted";
    case REJECTED = "rejected";


    public function label() : string
    {
        return match($this) {
            self::ACCEPTED => 'Accepted',
            self::REJECTED => 'Rejected'
        };
    }

}
