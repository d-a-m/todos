<?php

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
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
        $users = User::all();

        foreach (range(0, 10) as $i) {
            $todo = Todo::create([
               'title' => $faker->title,
                'description' => $faker->realText(100),
            ]);

            $user = $users->random();
            $user->todos()->attach($todo);

            if (rand(0, 10) < 5) {
                DB::table('transferred_todo')
                    ->insert([
                        'todo_id' => $todo->id,
                        'from_user_id' => $user->id,
                        'to_user_id' => $users->random()->id !== $user->id ?: $users->random()->id,
                    ]);
            }
        }
    }
}
