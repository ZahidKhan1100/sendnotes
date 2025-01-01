<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    //

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }

    public function with(): array
    {
        return [
            'title' => 'Show Notes',
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">No notes yet</p>
                <p class="text-sm">Let's create your first note to send</p>
                <x-button primary right-icon='plus' class="mt-6" href="{{ route('notes.create') }}" wire:navigate>Create
                    Note</x-button>
            </div>
        @else
            <x-button primary right-icon='plus' class="mb-12" href="{{ route('notes.create') }}" wire:navigate>Create
                Note</x-button>

            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                @foreach ($notes as $note)
                    <x-card wire:key='{{ $note->id }}' class="flex flex-col">
                        <div class="flex flex-col gap-y-1">
                            <a class="font-bold heading hover:underline hover:text-blue-500" href="{{route('notes.edit',$note)}}" wire:navigate>{{ $note->title }}</a>
                            <p>{{ Str::limit($note->body, 30, '...') }}</p>
                        </div>
                        <div class="flex flex-row justify-between mt-10">
                            <div>
                                <p>Recipient</p>
                                <p>{{ $note->recipient }}</p>
                            </div>

                            <div class="flex flex-col gap-x-1">
                                <p class="text-gray-500 ">{{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                                </p>

                                <div class="flex flex-row justify-end gap-2 ju">
                                    <x-mini-button rounded info label="i"></x-mini-button>
                                    <x-mini-button rounded icon="trash"
                                        wire:click="delete('{{ $note->id }}')"></x-mini-button>
                                </div>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
