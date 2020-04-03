<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\TrainingController;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class testGenerateTrainingWords extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {

        $category = Category::find(31);
        $user = User::find(1);
        $trainingController = new TrainingController();

        for ($i = 0; $i < 10; $i++) {
            $words = $trainingController->getWordsFromCategory($category, $user);
            $prepareWords = $trainingController->prepareTrainingWords($words);

            foreach ($prepareWords as $word) {
                $this->assertCount(3, $word['options']);
            }

        }

    }
}
