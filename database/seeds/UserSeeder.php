<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->truncate();
        DB::table('transferred_todo')->truncate();

        $faker = Faker\Factory::create();

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345'),
            'api_token' => Str::random(60),
            'is_admin' => true,
        ]);

        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt(Str::random(10)),
                'api_token' => Str::random(60),
                'is_admin' => false,
            ]);
        }


    }
}
