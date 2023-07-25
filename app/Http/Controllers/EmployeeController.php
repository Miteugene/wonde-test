<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Employee\EmployeeIndexAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class EmployeeController extends BaseController
{
    /**
     * @param EmployeeIndexAction $action
     * @return JsonResponse
     * @throws \Wonde\Exceptions\InvalidTokenException
     */
    public function index(EmployeeIndexAction $action): JsonResponse
    {
        return new JsonResponse([
            'data' => $action->handle(),
        ]);
    }

}
