<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Lesson\LessonShowAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class LessonsController extends BaseController
{
    /**
     * @param LessonShowAction $action
     * @return JsonResponse
     * @throws \Wonde\Exceptions\InvalidTokenException
     */
    public function show(LessonShowAction $action): JsonResponse
    {
        return new JsonResponse([
            'data' => $action->handle(),
            'meta' => $action->getMeta(),
        ]);
    }

}
