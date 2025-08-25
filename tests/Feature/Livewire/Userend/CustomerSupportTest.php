<?php

namespace Tests\Feature\Livewire\Userend;

use App\Livewire\Userend\CustomerSupport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerSupportTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CustomerSupport::class)
            ->assertStatus(200);
    }
}
