<?php

namespace App\Enums;

enum TicketStatus : string
{
    case ACCEPT = "accepted";
    case REJECT = "rejected";

    public function label() : string
    {
        return match($this) {
            self::ACCEPT => 'ACCEPTED',
            self::REJECT => 'REJECTED'
        };
    }
}
