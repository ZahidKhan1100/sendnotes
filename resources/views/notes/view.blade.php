<x-guest-layout>
    <div class="flex flex-col w-full h-full">
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-bold heading">{{ $notes->title }}</h1>
            <p>{{ $notes->body }}</p>
        </div>
        <div class="flex items-center justify-end mt-6 space-x-2">
            <h3 class="text-sm">Sent from <span class="font-bold">{{ $user['name'] }}</span></h3>
            <livewire:heartreact :note="$notes">
        </div>
    </div>
</x-guest-layout>
