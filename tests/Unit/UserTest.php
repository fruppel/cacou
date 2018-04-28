<?php
namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::create(2018, 5, 25));
    }

    /** @test */
    public function a_user_has_a_correct_age_based_on_his_birthday()
    {
        Carbon::setTestNow(Carbon::create(2018, 03, 26));
        $user = factory(User::class)->make(['birthdate' => '1990-10-15']);
        $this->assertEquals(27, $user->age);
    }

    /** @test */
    public function a_user_cannot_be_created_with_an_unknown_gender()
    {
        $this->expectException(\InvalidArgumentException::class);
        factory(User::class)->make(['gender' => 'XXX']);
    }
}
