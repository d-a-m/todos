<?php


namespace App\Api\Transformers;


class DepositTransformer extends Transformer
{
    private $except = ['updated_at', 'created_at', 'sravni_id'];

    /**
     * @param $item
     * @return array
     */
    public function transform($item) : array
    {
        $filtered = array_filter($item, function($key){
            return ! in_array($key, $this->except);
        }, ARRAY_FILTER_USE_KEY);

        return $filtered;
    }
}