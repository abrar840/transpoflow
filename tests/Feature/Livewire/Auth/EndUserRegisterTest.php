<?php

namespace Tests\Feature\Livewire\Auth;

use App\Livewire\Auth\EndUserRegister;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EndUserRegisterTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EndUserRegister::class)
            ->assertStatus(200);
    }
}
