<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Dto\AddCountryToStatisticDto;
use App\Domain\RepositoryInterface\CountryStatisticRepositoryInterface;
use App\Infrastructure\Http\ApiResponse;
use Throwable;

final class AddCountryToStatisticHandler
{
    private CountryStatisticRepositoryInterface $countryStatisticRepository;

    public function __construct(CountryStatisticRepositoryInterface $countryStatisticRepository)
    {
        $this->countryStatisticRepository = $countryStatisticRepository;
    }

    public function handle(AddCountryToStatisticDto $requestDto): ApiResponse
    {
        try {
            $this->countryStatisticRepository->add($requestDto->getCountryCode());
        } catch (Throwable $e) {
            return new ApiResponse(['result' => sprintf('Fail: %s', $e->getMessage())], ApiResponse::HTTP_BAD_GATEWAY);
        }

        return new ApiResponse(['result' => 'Ok']);
    }
}
