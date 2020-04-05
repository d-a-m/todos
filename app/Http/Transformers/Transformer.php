<?php


namespace App\Api\Transformers;


abstract class Transformer
{
    /**
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items) : array
    {
        return array_map([$this, 'transform'], $items);
    }

    abstract public function transform($item);
}