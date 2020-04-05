<?php


namespace App\Http\Controllers\Api;


use App\Helpers\SecureHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode = 200)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondNotFound($message = 'Not found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondBadRequest($message = 'Bad request!')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondUnauthorized ($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'code' => $this->statusCode
            ]
        ]);
    }

    /**
     * @param $data
     * @param array $headers
     * @return JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param mixed $items
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function getItems($items, int $page, int $perPage)
    {
        $page = $page ?: 1;

        if ($page) {
            $skip = $perPage * ($page - 1);
            $rawQuery = $items->take($perPage)->skip($skip);
        } else {
            $rawQuery = $items->take($perPage)->skip(0);
        }

        return $rawQuery->get();
    }


    /**
     * @param string $url
     * @param int $userVkId
     * @return bool
     */
    protected function checkUser(string $url, int $userVkId)
    {
        if (!$url || !$userVkId) {
            return false;
        }

        $isTrueSign = SecureHelper::checkUserSign($url, $userVkId);

        if ($isTrueSign === false) {
            return false;
        }

        return true;
    }

}