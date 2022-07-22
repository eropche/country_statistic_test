<?php

declare(strict_types=1);

namespace App\Application\RequestArgumentResolver;

use App\Application\Dto\AddCountryToStatisticDto;
use Generator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class AddCountryRequestResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        if ($argument->getType() !== AddCountryToStatisticDto::class) {
            return false;
        }

        return true;
    }

    /**
     * @return Generator<AddCountryToStatisticDto>
     */
    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $countryCode = strtolower($request->get('countryCode', ''));
        if (!AddCountryToStatisticDto::isValidCode($countryCode)) {
            throw new BadRequestException('Invalid parameter - countryCode');
        }

        yield new AddCountryToStatisticDto($countryCode);
    }
}
