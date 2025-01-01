<?php

use Livewire\Volt\Component;

new class extends Component {
    //
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteDate' => ['required', 'date'],
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteDate,
                'is_published' => true,
            ]);
        return redirect(route('notes.index'));
    }
}; ?>

<div class="flex flex-col items-center justify-center w-full h-full">
    <div class="flex w-[50%]">
        <x-button primary icon='arrow-left' class="mb-6" href="{{ route('notes.index') }}" wire:navigate>All
            Notes</x-button>
    </div>
    <form wire:submit.prevent='submit' class="flex flex-col w-[50%] space-y-2">
        <x-input wire:model='noteTitle' label='Title' placeholder="It's been a great day"></x-input>
        <x-textarea wire:model='noteBody' label='Body'
            placeholder='Share all your thoughts with your friend'></x-textarea>
        <x-input icon='user' wire:model='noteRecipient' label='Recipient' placeholder='yourfriend@email.com'
            type='email'></x-input>
        <x-input icon='calendar' wire:model='noteDate' type='date' label='Date' placeholder='Date'></x-input>
        <div class="pt-4">
            <x-button class="w-full" type="submit" right-icon='calendar' spinner>Schedule Note</x-button>
        </div>
        <x-errors/>
    </form>
</div>
