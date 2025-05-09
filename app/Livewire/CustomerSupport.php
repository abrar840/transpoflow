<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;

class CustomerSupport extends Component
{
    public $messages;
    public $selectedMessage;

    public function mount()
    { 
        $this->messages = Message::with(['company', 'user'])
            ->latest()
            ->get();
    }

    public function viewMessage($id)
    {
        $this->selectedMessage = Message::find($id);
        $this->selectedMessage->update(['read' => true]);
    }

    public function deleteMessage($id)
    {
        Message::find($id)->delete();
        $this->messages = Message::latest()->get();
    }

    public function render()
    {
        return view('livewire.customer-support')
            ->layout('layouts.app');
    }
}