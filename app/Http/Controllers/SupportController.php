<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Models\TicketAssignee;
use App\Models\TicketModel;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class SupportController extends Controller
{
    use ResponseTrait;

    /**
     * Set Ticket Accept or Reject
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function ticketStatus(Request $request) : JsonResponse
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
    public function assignTicketToLead(Request $request) : JsonResponse
    {
        try {
            $request = (object) $request->validate([
                'user_id' => 'integer|required|exists:users,id',
                'ticket_id' => 'integer|required|exists:tickets,id'
            ]);

            $ticketID = $request->ticket_id;
            $userID = $request->user_id;

            $assignee =  TicketAssignee::where('user_id',$userID)->where('ticket_id',$ticketID);

            if($assignee->exists()) throw new \Exception("Ticket is already assgin", 500);

            $assignTicket =  TicketAssignee::create([
                'ticket_id' => $ticketID,
                'user_id' => $userID,
                'order' => $assignee->count() + 1
            ]);


            return $this->sucessResponse('Successfully Assign Ticket.',['data' => $assignTicket->load('users')]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }
}
