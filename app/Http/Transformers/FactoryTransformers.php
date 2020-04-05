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
            case 'todo':
                $transformer = new TodoTransformer();
                break;
            case 'user':
                $transformer = new UserTransformer();
                break;
            default:
                throw new \Exception('Unknown transformer type - ' . $type);
        }

        return $transformer;
    }

}