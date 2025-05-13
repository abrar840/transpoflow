<?php

namespace Tests\Feature\Livewire;

use App\Livewire\BusinessForm;
use App\Models\Company;
use App\Models\CompanyService;
use App\Models\CompanyTheme;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class BusinessFormTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $services = [];

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test user
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create test services matching your actual database
        $this->services[] = Service::create(['name' => 'FleetManagement']);
        $this->services[] = Service::create(['name' => 'TicketManagement']);
        $this->services[] = Service::create(['name' => 'CustomerSupport']);
        $this->services[] = Service::create(['name' => 'CargoManagement']);
    }

    

    /** @test */
    public function it_redirects_if_user_already_has_company()
    {
        $company = Company::create([
            'name' => 'Existing Company',
            'user_id' => $this->user->id,
            'type' => 'fleet',
            'email' => 'company@test.com',
            'admin_username' => 'admin',
            'num_employees' => '5-20'
        ]);
        
        $this->user->company_id = $company->id;
        $this->user->save();
        
        $this->actingAs($this->user);
        
        Livewire::test(BusinessForm::class, ['theme' => 'light'])
            ->assertRedirect(route('AdminPanel'));
    }

 

    /** @test */
    public function it_validates_email_format_and_uniqueness()
    {
        Company::create([
            'name' => 'Existing Company',
            'user_id' => $this->user->id,
            'type' => 'fleet',
            'email' => 'exists@test.com',
            'admin_username' => 'admin',
            'num_employees' => '5-20'
        ]);
        
        $this->actingAs($this->user);
        
        Livewire::test(BusinessForm::class, ['theme' => 'light'])
            ->set('email', 'invalid-email')
            ->call('submit')
            ->assertHasErrors(['email' => 'email'])
            ->set('email', 'exists@test.com')
            ->call('submit')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    public function it_validates_company_name_uniqueness()
    {
        Company::create([
            'name' => 'Existing Company',
            'user_id' => $this->user->id,
            'type' => 'fleet',
            'email' => 'exists@test.com',
            'admin_username' => 'admin',
            'num_employees' => '5-20'
        ]);
        
        $this->actingAs($this->user);
        
        Livewire::test(BusinessForm::class, ['theme' => 'light'])
            ->set('name', 'Existing Company')
            ->call('submit')
            ->assertHasErrors(['name' => 'unique']);
    }

    /** @test */
    public function it_validates_logo_file_type_and_size()
    {
        Storage::fake('public');
        
        $this->actingAs($this->user);
        
        // Test invalid file type
        $invalidFile = UploadedFile::fake()->create('document.pdf', 1000);
        
        Livewire::test(BusinessForm::class, ['theme' => 'light'])
            ->set('name', 'Test Company')
            ->set('type', 'fleet')
            ->set('email', 'test@example.com')
            ->set('admin_username', 'testadmin')
            ->set('services', [$this->services[0]->id])
            ->set('logo', $invalidFile)
            ->call('submit')
            ->assertHasErrors(['logo' => 'image']);
            
        // Test file size too large
        $largeFile = UploadedFile::fake()->image('logo.jpg')->size(3000);
        
        Livewire::test(BusinessForm::class, ['theme' => 'light'])
            ->set('name', 'Test Company')
            ->set('type', 'fleet')
            ->set('email', 'test@example.com')
            ->set('admin_username', 'testadmin')
            ->set('services', [$this->services[0]->id])
            ->set('logo', $largeFile)
            ->call('submit')
            ->assertHasErrors(['logo' => 'max']);
    }

 
    /** @test */
// public function it_handles_multiple_rapid_submissions()
// {
//     Storage::fake('public');

    

//     $user = User::factory()->create();

//     for ($i = 0; $i < 2; $i++) {
//         Livewire::actingAs($user)
//             ->test(BusinessForm::class, ['theme' => 'light'])
//             ->set('name', "Test Company $i")
//             ->set('user_id', $user->id) // ✅ Correct ID
//             ->set('type', 'fleet')
//             ->set('email', "test$i@example.com")
//             ->set('admin_username', "admin$i") // ✅ Required
//             ->set('services', [1]) // ✅ Valid
//             ->call('submit')
//             ->assertHasNoErrors();
//     }

//     // $this->assertCount(2, Company::all()); // ✅ Matches loop
//     unset($test);
// }
}