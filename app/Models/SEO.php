<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{

    /**
     * @var string
     */
    protected $table = "seo";

    /**
     * @var string
     */
    public static $uploadDirectory = 'uploads/seo/';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Массив с дежурными сообщениями о результате выполненной операции
     * @var array
     */
    public static $alerts = [
        'success_create' => 'Категория успешно добавлена!',
        'error_create' => 'Категория не была добавлена!',
        'success_update' => 'Категория успешно отредактирована!',
        'error_update' => 'Категория не была отредактирована!',
        'success_destroy' => 'Категория успешно удалена!',
        'error_destroy' => 'Категория не была удалена!',
    ];

    public static function getSEOSettings ($id)
    {
        $model = SEO::findOrFail($id);

        $meta['title'] = SEO::replaceTags($model->meta_title);
        $meta['description'] = SEO::replaceTags($model->meta_description);
        $meta['keywords'] = SEO::replaceTags($model->keywords);
        $meta['name'] = SEO::replaceTags($model->title);
        $meta['canonical'] = SEO::replaceTags($model->canonical);
        $meta['url'] = SEO::replaceTags($model->canonical);
        $meta['miniature'] = $model->meta_miniature ?? '';
        $meta['content'] = SEO::replaceTags($model->content);

        return $meta;
    }

    public static function getEmptyMeta ($title)
    {
        $meta['title'] = $title;
        $meta['description'] = '';
        $meta['keywords'] = '';
        $meta['name'] = $title;
        $meta['canonical'] = '';
        $meta['url'] = '';
        $meta['miniature'] = '';
        $meta['content'] = '';

        return $meta;
    }

    /**
     * Замена шаблонов в строках
     * @param $data
     * @return mixed
     */
    private static function replaceTags($data)
    {

        /**
         *  %current_year% - текущий год
         *  %current_year_plus_one% - текущий год + 1
         */

        preg_match_all('/{(.*?)}/', $data, $result);

        if (count($result) > 0) {
            foreach ($result[1] as $setting) {
                $setting = explode('.', $setting);

                if ($setting[0] == 'city') {
                    $url_city = explode('/', url()->current())[3];

                    // Есть указание на падеж города
                    if (isset($setting[1])) {
                        $city = config()->get('cities.' . $url_city)['cases'][$setting[1]];
                        $data = str_replace('{' . $setting[0] . '.' . $setting[1] . '}', $city, $data);
                    } else {
                        $data = str_replace('{' . $setting[0] . '}', $url_city, $data);
                    }


                }
            }
        }

        if (strpos($data, '%current_year%') !== false) {
            $data = str_replace('%current_year%', now()->year, $data);
        }

        if (strpos($data, '%current_year_plus_one%') !== false) {
            $data = str_replace('%current_year_plus_one%', now()->year + 1, $data);
        }

        if (strpos($data, '%current_year_plus_two%') !== false) {
            $data = str_replace('%current_year_plus_two%', now()->year + 2, $data);
        }

        if (strpos($data, '%current_year_plus_three%') !== false) {
            $data = str_replace('%current_year_plus_three%', now()->year + 3, $data);
        }

        if (strpos($data, '%current_year_plus_four%') !== false) {
            $data = str_replace('%current_year_plus_four%', now()->year + 3, $data);
        }

        return $data;
    }
}
