<?php

namespace App\Console\Commands;

use App\Helpers\WordHelper;
use App\Models\User;
use App\Repositories\Factory\RepositoryFactory;
use Illuminate\Console\Command;

class GenerateDailyWords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailywords:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating daily words for user';

    private $userRepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->userRepo = RepositoryFactory::make(new User());
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->userRepo->getAll()->get();

        foreach ($users as $user) {
            $dailyWords = WordHelper::generateDailyWords($user);
            WordHelper::updateProgress($user, $dailyWords);

            $ids = [];

            foreach ($dailyWords as $word) {
                $ids[] = $word['id'];
            }

            $user->dailyWords()->sync($ids);
        }
    }
}
