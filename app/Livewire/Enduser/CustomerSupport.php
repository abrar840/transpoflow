<?php
namespace App\Livewire\Enduser;

use Livewire\Component;
use App\Models\Company;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class CustomerSupport extends Component
{
    public $company;
    public $theme = 'light';
    public $name, $email, $subject, $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:5',
        'message' => 'required|min:10'
    ];

    public function mount(Company $company)
    {
        $this->company = $company;
        $this->theme = $company->theme ?? 'light';
        
        if (auth('end_user')->check()) {
            $user = auth('end_user')->user();
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function submit()
    {
        $this->validate();

        Message::create([
            'company_id' => $this->company->id,
            'user_id' => auth('end_user')->id(),
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message
        ]);

        session()->flash('message', 'Your message has been sent successfully!');
        $this->reset(['name', 'email', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.enduser.customer-support')->layout('layouts.user');
    }
}