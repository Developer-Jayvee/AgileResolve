<?php

use App\Enums\TicketProgressStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_workflow', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets','id');
            $table->foreignId('assignee_id');
            $table->enum("prev_status",TicketProgressStatus::cases())->nullable();
            $table->enum("curr_status",TicketProgressStatus::cases());
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_workflow');
    }
};
