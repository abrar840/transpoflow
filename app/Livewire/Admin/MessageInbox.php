<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Message;

class MessageInbox extends Component
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
        return view('livewire.admin.message-inbox')
            ->layout('layouts.user');
    }
}