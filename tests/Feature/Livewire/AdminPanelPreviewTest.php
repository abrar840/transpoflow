<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AdminPanelPreview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelPreviewTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AdminPanelPreview::class)
            ->assertStatus(200);
    }
}
