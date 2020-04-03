<?php

namespace App\Console\Commands;

use App\Models\Word;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearDeletedWordsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'words:cleardeleted';

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
        $wordsIds = DB::table('category_word')
            ->select('word_id')
            ->get();

        foreach ($wordsIds as $id) {

            $word = Word::find($id->word_id);

            if (! $word) {
                dump($id->word_id);
                DB::table('category_word')->where('word_id', $id->word_id)->delete();
            }

        }

        dd($wordsIds);

    }
}
