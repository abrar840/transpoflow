<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ThemePreviewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ThemePreviewerTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ThemePreviewer::class)
            ->assertStatus(200);
    }
}
