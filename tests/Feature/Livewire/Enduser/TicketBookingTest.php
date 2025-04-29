<?php

namespace Tests\Feature\Livewire\Enduser;

use App\Livewire\Enduser\TicketBooking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TicketBookingTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TicketBooking::class)
            ->assertStatus(200);
    }
}
