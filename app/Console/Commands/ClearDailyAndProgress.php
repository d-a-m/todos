<?php

namespace App\Console\Commands;

use App\Models\DailyWord;
use App\Models\Progress;
use Illuminate\Console\Command;

class ClearDailyAndProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyprogress:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clearing offer rating';

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
        DailyWord::query()->truncate();
        Progress::query()->truncate();
    }
}
