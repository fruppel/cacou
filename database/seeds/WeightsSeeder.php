<?php

use Illuminate\Database\Seeder;

class WeightsSeeder extends Seeder
{

    private const EMAIL = 'johndoe@example.com';

    /**
     * Runs the database seeds
     *
     * @return void
     */
    public function run()
    {
        $this->clear();

        $user = factory(App\User::class)->create([
            'name' => 'John Doe',
            'email' => self::EMAIL,
            'password' => bcrypt('asdasd'),
        ]);

        factory(App\Weight::class, 20)->create([
            'user_id' => $user->id
        ]);
    }

    /**
     * Clears all seeded data
     *
     * @return void
     */
    private function clear()
    {
        $user = App\User::where('email', self::EMAIL)->first();

        if (!$user) return;

        $user->delete();
    }
}