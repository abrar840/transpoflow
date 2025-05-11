<div>
    <div class="mb-6 bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4">Export Company Data</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="startDate" class="block text-sm font-medium text-gray-700">From Date</label>
                <input type="date" wire:model="startDate" id="startDate" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('startDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="endDate" class="block text-sm font-medium text-gray-700">To Date</label>
                <input type="date" wire:model="endDate" id="endDate" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('endDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <button 
            wire:click="export" 
            wire:loading.attr="disabled"
            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md inline-flex items-center transition-colors duration-150"
            :disabled="!startDate || !endDate"
        >
            <span wire:loading.remove wire:target="export">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export Data
            </span>
            <span wire:loading wire:target="export">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Preparing Export...
            </span>
        </button>

        @if($exportInProgress)
        <div class="mt-4 text-blue-600 text-sm">
            Your export is being prepared. The download will start automatically when ready...
        </div>
        @endif
    </div>
</div>