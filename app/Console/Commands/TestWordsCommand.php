<?php

namespace App\Console\Commands;

use App\Models\Word;
use Illuminate\Console\Command;

class TestWordsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:word';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $words = Word::all();

        $maxLength = 0;
        $maxIndex = 0;

        foreach ($words as $word) {
            if (strpos($word->word, ' ') === false) {
                if (mb_strlen($word->word) >= $maxLength) {
                    $maxLength = mb_strlen($word->word);
                    $maxIndex = $word->id;
                }
            }
        }

        dump("Длина: " . $maxLength);
        dd("id: " . $maxIndex);

//        array_map(function($item) {
//            if (mb_strlen($item["translation"]) >= 40) {
//                dump($item);
//            }
//        }, $words->toArray());
    }
}
