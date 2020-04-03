<?php


namespace App\Api\Transformers;


class WordTransformer extends Transformer
{
    private $except = ['updated_at', 'created_at'];

    /**
     * @param $item
     * @return array
     */
    public function transform($item) : array
    {
        if (! is_array($item)) {
            $item = $item->toArray();
        }

        $filtered = array_filter($item, function($key){
            return ! in_array($key, $this->except);
        }, ARRAY_FILTER_USE_KEY);

        return $filtered;
    }
}