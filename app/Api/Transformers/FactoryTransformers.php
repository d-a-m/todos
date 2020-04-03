<?php


namespace App\Api\Transformers;


class FactoryTransformers
{
    /**
     * @param string $type
     * @return Transformer
     * @throws \Exception
     */
    public static function make(string $type): Transformer
    {
        $transformer = null;

        switch ($type) {
            case 'category':
                $transformer = new CategoryTransformer();
                break;
            case 'word':
                $transformer = new WordTransformer();
                break;
            default:
                throw new \Exception('Unknown transformer type - ' . $type);
        }

        return $transformer;
    }

}