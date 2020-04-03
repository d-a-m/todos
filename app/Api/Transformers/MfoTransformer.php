<?php


namespace App\Api\Transformers;


class MfoTransformer extends Transformer
{
    private $except = [
        'phone',
        'address',
        'currency',
        'vk_link',
        'epc',
        'document_link',
        'ar',
        'moment_accept',
        'updated_at',
        'created_at'
    ];

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