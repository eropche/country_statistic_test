<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Dto\AddCountryToStatisticDto;
use App\Application\Handler\AddCountryToStatisticHandler;
use App\Application\Handler\GetAllCountryStatisticHandler;
use App\Infrastructure\Http\ApiResponse;

final class StatisticController
{
    public function addCountry(AddCountryToStatisticDto $requestDto, AddCountryToStatisticHandler $handler): ApiResponse
    {
        return $handler->handle($requestDto);
    }

    public function getAll(GetAllCountryStatisticHandler $handler): ApiResponse
    {
        return $handler->handle();
    }
}
