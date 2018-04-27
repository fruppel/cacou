<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagingWeightsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthorized_users_cannot_access_the_weights_page()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->get('/weight/' . $user->id)
            ->assertRedirect('/login');
    }

    /** @test */

    public function an_user_can_add_weight()
    {
        $user = factory(User::class)->create();
        $weightUrl = '/weight/' . $user->id;

        $this->actingAs($user);

        $this->get($weightUrl)
            ->assertStatus(200);

        $this->post($weightUrl, [
            'weight' => 90.5,
            'created_at' => Carbon::now(),
        ]);
    }

}
