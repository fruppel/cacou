<?php

namespace Tests\Feature;

use App\CaloricRequirementCalculator;
use App\User;
use App\Weight;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CaloricRequirementCalculatorTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var CaloricRequirementCalculator
     */
    private $crc;

    public function setUp()
    {
        parent::setUp();

        $knownDate = Carbon::create(2018, 5, 25);
        Carbon::setTestNow($knownDate);

        $this->crc = new CaloricRequirementCalculator();
    }

    /**
     * @test
     */
    public function it_calculates_the_correct_bmr_for_men()
    {
        $user = $this->createUser([
            'gender' => 'male',
            'height' => 186,
            'birthdate' => '1986-06-01'
        ], [
            'weight' => 86.0
        ]);

        $this->assertEquals(1918.185, $this->crc->calculate($user));
    }

    /**
     * @test
     */
    public function it_calculates_the_correct_bmr_for_women()
    {
        $user = $this->createUser([
            'gender' => 'female',
            'height' => 165,
            'birthdate' => '1992-02-03'
        ], [
            'weight' => 72.0
        ]);

        $this->assertEquals(1490.675, $this->crc->calculate($user));
    }
}
