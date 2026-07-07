<!-- filepath: resources/views/livewire/customer-support.blade.php -->
<div class="container mx-auto p-4">
    <x-admin.page-header title="Customer Support" icon="headset"
        subtitle="View and respond to messages from your customers." />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Message List -->
        <div class="col-span-1 bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-4">Inbox</h2>
            <div class="space-y-2 max-h-96 overflow-y-auto">
                @foreach($messages as $message)
                    <div 
                        wire:click="viewMessage({{ $message->id }})"
                        class="p-3 border rounded cursor-pointer {{ $message->read ? 'bg-gray-50' : 'bg-blue-50' }}"
                    >
                        <div class="font-medium truncate">{{ $message->subject }}</div>
                        <div class="text-sm text-gray-600 truncate">{{ $message->name }} ({{ $message->email }})</div>
                        <div class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Message Detail -->
        <div class="col-span-2 bg-white rounded-lg shadow p-4 min-h-[300px]">
            @if($selectedMessage)
                <div class="mb-4">
                    <button 
                        wire:click="deleteMessage({{ $selectedMessage->id }})"
                        class="bg-red-500 text-white px-3 py-1 rounded text-sm"
                    >
                        Delete
                    </button>
                </div>
                <h2 class="text-xl font-semibold break-words">{{ $selectedMessage->subject }}</h2>
                <div class="text-sm text-gray-600 mb-4 break-words">
                    From: {{ $selectedMessage->name }} ({{ $selectedMessage->email }})<br>
                    Company: {{ $selectedMessage->company->name }}<br>
                    Date: {{ $selectedMessage->created_at->format('M d, Y H:i') }}
                </div>
                <div class="border-t pt-4 break-words whitespace-pre-line">
                    {{ $selectedMessage->message }}
                </div>
            @else
                <p class="text-gray-500">Select a message to view details</p>
            @endif
        </div>
    </div>
</div>