<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiariesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_cannot_create_diary_entries()
    {
        $this->withExceptionHandling()
            ->post('/diary', [])->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_create_diary_entries()
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $this->withExceptionHandling()
            ->postJson('/diary', [
                'description' => 'Test description',
                'calories' => 250,
                'day' => '2018-05-12',
            ])
            ->assertStatus(201);

        $this->assertCount(1, $user->diary);

    }
}
