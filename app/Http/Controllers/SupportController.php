<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Models\TicketAssignee;
use App\Models\TicketModel;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class SupportController extends Controller
{
    use ResponseTrait;

    public function ticketStatus(Request $request)
    {
        try {
            $request = ( object ) $request->validate([
                'status' => ['required',new Enum(TicketStatus::class)],
                'ticket_id' => 'required|exists:tickets,id'
            ]);
            $status = TicketStatus::tryFrom($request->status);
            $ticket = TicketModel::find($request->ticket_id);
            if($ticket){
                $ticket->update([
                    'status' => $status->value
                ]);
            }
            return $this->sucessResponse("Successfully {$status->label()}",['data'=>$ticket]);

        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
}
