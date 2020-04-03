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
        DB::table('todo_user')->truncate();
        DB::table('transferred_todo')->truncate();

        $faker = Faker\Factory::create();

        foreach (range(0, 3) as $i) {
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
