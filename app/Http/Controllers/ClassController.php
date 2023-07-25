<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Class\ClassShowAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ClassController extends BaseController
{
    /**
     * @param ClassShowAction $action
     * @return JsonResponse
     * @throws \Wonde\Exceptions\InvalidTokenException
     */
    public function show(ClassShowAction $action): JsonResponse
    {
        return new JsonResponse([
            'data' => $action->handle(),
        ]);
    }
}
