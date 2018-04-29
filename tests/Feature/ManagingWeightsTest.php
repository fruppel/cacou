<?php

namespace Tests\Feature;

use App\User;
use App\Weight;
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

    /** @test */
    public function a_weight_entry_can_be_deleted()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $weight = factory(Weight::class)->create(['user_id' => $user->id]);
        $allWeights = Weight::all();

        $this->assertEquals(1, $allWeights->count());

        $this->delete('/weight/' . $user->id . '/' . $weight->id);

        $this->assertEquals(0, Weight::all()->count());
    }

    /** @test */
    public function a_user_can_only_delete_his_weight()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create(['id' => 1]);
        $this->actingAs($user);

        $weight = factory(Weight::class)->create(['user_id' => 2]);

        $this->delete('/weight/1/' . $weight->id)->assertStatus(403);

        $this->assertEquals(1, Weight::all()->count());
    }


}
