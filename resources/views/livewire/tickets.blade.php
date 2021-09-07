<div>
    Tickets

    <div class="w-96 mx-auto pt-5">
        @foreach ($tickets as $ticket)
            <div class="border-b-2 mt-3 {{ $active === $ticket->id ? 'bg-gray-200' : '' }}">
                <div class="flex text-sm justify-between mb-1.5"
                    wire:click='$emit("ticketSelected", {{ $ticket->id }})'>
                    <p>{{ $ticket->question }}</p>
                </div>
            </div>
        @endforeach

    </div>
</div>
