<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a Notes') }}
        </h2>
    </x-slot>


    <div class="py-12 ">
        <div class="mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8">
        
            <div class="p-6 space-y-4 text-gray-900">
                @livewire('notes.create-note')
            </div>
        </div>
    </div>
</x-app-layout>
