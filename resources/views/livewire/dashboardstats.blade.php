<?php

use Livewire\Volt\Component;

new class extends Component {
    //
    public function with()
    {
        return [
            'pastNotesSentCount' => Auth::user()->notes()->where('send_date', '<', now())->where('is_published', true)->count(),
            'notesLovedCount' => Auth::user()->notes()->sum('heart_count'),
        ];
    }
}; ?>

<div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="flex flex-col gap-2 p-8 bg-purple-200 shadow-md rounded-xl">
            <h1 class="text-2xl font-bold">Notes Sent</h1>
            <p class="text-xl">{{ $pastNotesSentCount }}</p>
        </div>

        <div class="flex flex-col gap-2 p-8 bg-purple-200 shadow-md rounded-xl">
            <h1 class="text-2xl font-bold">Notes Loved</h1>
            <p class="text-xl">{{ $notesLovedCount }}</p>
        </div>
    </div>
</div>
