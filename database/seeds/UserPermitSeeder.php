<?php

use App\User;
use Illuminate\Database\Seeder;

class UserPermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->permits()->save(factory(App\Permit::class)->make());
        });
    }
}
