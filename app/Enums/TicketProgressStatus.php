<?php

namespace App\Enums;

enum TicketProgressStatus : string
{
    case OPEN = "open";
    case INPROGRESS = "in-progress";
    case DONE = "done";

    public function label(){
        return match($this) {
            self::OPEN => 'Open',
            self::INPROGRESS => 'In-Progress',
            self::DONE => 'Done'
        };
    }
}
