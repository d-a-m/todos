<?php

namespace App\Console\Commands;

use App\Helpers\RatingsHelper;
use App\Models\User;
use App\Repositories\Contract\Repository;
use App\Repositories\Factory\RepositoryFactory;
use Illuminate\Console\Command;

class UpdateRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rating:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating user rating';

    /**
     * @var Repository
     */
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
        logs()->info('Updating rating has been run');

        $users = $this->userRepo->getAll()->get();

        foreach ($users as $user) {
            $rating = RatingsHelper::countRating($user);

            if ($user->rating) {
                $user->rating()->update([
                    'rating' => $rating
                ]);
            } else {
                $user->rating()->create([
                    'rating' => $rating,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
