<?php

namespace Tests\Feature\Livewire\Enduser;

use App\Livewire\Enduser\CargoBooking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CargoBookingTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CargoBooking::class)
            ->assertStatus(200);
    }
}
