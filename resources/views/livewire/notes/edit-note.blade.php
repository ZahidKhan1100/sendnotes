<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    //
    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;

        // new changes
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteDate' => ['required', 'date'],
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteDate,
            'is_published' => $this->noteIsPublished,
        ]);

        $this->dispatch("note-saved");
        session()->flash('message', 'Note updated successfully!');
        // $this->dispatch('delayed-redirect', ['url' => route('notes.index')]);
        return redirect(route('notes.index'));
    }
}; ?>


<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Note') }}
    </h2>
</x-slot>


<div class="py-12 ">
    <div class="mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8">

        <div class="p-6 space-y-4 text-gray-900">
            <form wire:submit.prevent='saveNote' class="flex flex-col w-[50%] space-y-2">
                <x-input wire:model='noteTitle' label='Title' placeholder="It's been a great day"></x-input>
                <x-textarea wire:model='noteBody' label='Body' placeholder='Share all your thoughts with your friend'>
                </x-textarea>
                <x-input icon='user' wire:model='noteRecipient' label='Recipient' placeholder='yourfriend@email.com'
                    type='email'></x-input>
                <x-input icon='calendar' wire:model='noteDate' type='date' label='Date'
                    placeholder='Date'></x-input>
                <x-checkbox label="Note Published" wire:model='noteIsPublished'></x-checkbox>
                <div class="flex justify-between pt-4">
                    <x-button class="w-full" type="submit" primary spinner="saveNote">Update Note</x-button>
                    <x-button class="w-full" flat href="{{route('notes.index')}}" wire:navigate>Back to notes</x-button>
                </div>
                <x-action-message on="note-saved"></x-action-message>
                <x-errors/>
            </form>
        </div>
    </div>
</div>

