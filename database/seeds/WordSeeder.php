<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('words')->truncate();
        DB::table('category_word')->truncate();
        DB::table('progress')->truncate();
        DB::table('words_day')->truncate();
        DB::table('rating')->truncate();
        DB::table('dictionary')->truncate();
        DB::table('sqlite_sequence')->update([
            'words' => 0,
            'category_word' => 0,
        ]);




//        $categoriesIds = Category::pluck('id')->toArray();
//        $categoriesIds = array_slice($categoriesIds, 0, 4);
//
//        for ($i = 0; $i < 20; $i++){
//            $word = Word::create([
//                'word' => 'word_' . $i,
//                'transcription' => 'wɜːd_' . $i,
//                'translation' => 'слово_' . $i,
//                'examples' => '',
//                'diffuculty' => 0,
//                'image' => '',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//
//            shuffle($categoriesIds);
//            $word->categories()->attach($categoriesIds[0]);
//        }
    }
}
