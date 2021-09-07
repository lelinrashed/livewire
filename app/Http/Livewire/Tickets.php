<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;

class Tickets extends Component
{
    public $active;

    protected $listeners = ['ticketSelected' => 'handleTicketSelect'];

    public function handleTicketSelect($ticketId)
    {
        $this->active = $ticketId;
    }
    
    public function render()
    {
        return view('livewire.tickets', [
            'tickets' => SupportTicket::all(),
        ]);
    }
}
