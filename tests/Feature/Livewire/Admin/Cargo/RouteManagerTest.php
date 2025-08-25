<?php

namespace Tests\Feature\Livewire\Admin\Cargo;

use App\Livewire\Admin\Cargo\RouteManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RouteManagerTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(RouteManager::class)
            ->assertStatus(200);
    }
}
