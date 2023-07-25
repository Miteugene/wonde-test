<?php

declare(strict_types=1);

namespace App\Features\Wonde;

use Wonde\Client as WondeClient;
use Wonde\Endpoints\Schools;
use Wonde\Exceptions\InvalidTokenException;

class GetSchoolFeature
{
    /**
     * @throws InvalidTokenException
     */
    public function handle(): Schools
    {
        return (new WondeClient(config('wonde.token')))
            ->school(config('wonde.school_id'));
    }
}
