<?php

declare(strict_types=1);

namespace App\Domain\RepositoryInterface;

interface CountryStatisticRepositoryInterface
{
    public function getGroupAll(): ?array;

    public function add(string $countryCode): void;
}
