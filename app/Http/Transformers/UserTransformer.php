<?php


namespace App\Api\Transformers;


class UserTransformer extends Transformer
{
    private $except = [];

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