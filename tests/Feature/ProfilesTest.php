<?php
namespace Tests\Feature;

use App\User;
use App\Weight;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_has_a_profile_page()
    {
        $user = $this->createUser();

        $this->get(route('user.show', $user))
            ->assertStatus(200)
            ->assertSee($user->name);
    }
}
