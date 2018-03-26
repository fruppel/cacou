<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_correct_age_based_on_his_birthday()
    {
        Carbon::setTestNow(Carbon::create(2018, 03, 26));
        $user = factory(User::class)->make(['birthdate' => '1990-10-15']);
        $this->assertEquals(27, $user->age);
    }
}
