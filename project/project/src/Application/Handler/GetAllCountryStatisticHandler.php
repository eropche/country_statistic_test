<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Domain\RepositoryInterface\CountryStatisticRepositoryInterface;
use App\Infrastructure\Http\ApiResponse;
use Throwable;

final class GetAllCountryStatisticHandler
{
    private CountryStatisticRepositoryInterface $countryStatisticRepository;

    public function __construct(CountryStatisticRepositoryInterface $countryStatisticRepository)
    {
        $this->countryStatisticRepository = $countryStatisticRepository;
    }

    public function handle(): ApiResponse
    {
        try {
            $statistic = $this->countryStatisticRepository->getGroupAll();
        }  catch (Throwable $e) {
            return new ApiResponse(['result' => sprintf('Fail: %s', $e->getMessage())], ApiResponse::HTTP_BAD_GATEWAY);
        }

        return new ApiResponse($statistic);
    }
}
