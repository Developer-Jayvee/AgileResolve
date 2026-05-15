<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\TicketModel;
use Illuminate\Http\Request;
use Override;

class TicketController extends ResourceController
{
    #[Override]
    protected function setParams()
    {
        $this->mainModel = new TicketModel;
        $this->storeRequest = new StoreTicketRequest;
        $this->updateRequest = new UpdateTicketRequest;
    }
}
