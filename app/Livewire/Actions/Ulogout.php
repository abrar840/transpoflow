<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
class ulogout
{
    /**
     * Log the current user out of the application.
     */
    
    public function __invoke(): RedirectResponse
    { 
        $companyName = session('company_name');
        //dd($companyName);
        Auth::guard('end_user')->logout();


        // Session::invalidate();
        // Session::regenerateToken();
        return redirect()->route('user-Home', ['company' => $companyName]);
    }

}
