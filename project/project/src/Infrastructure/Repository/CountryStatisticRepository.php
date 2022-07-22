<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\RepositoryInterface\CountryStatisticRepositoryInterface;
use Predis\ClientInterface;

final class CountryStatisticRepository implements CountryStatisticRepositoryInterface
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getGroupAll(): ?array
    {
        $result = [];
        foreach ($this->client->keys('*') as $key) {
            $result[$key] = $this->client->get($key);
        }

        return $result;
    }

    public function add(string $countryCode): void
    {
        // тут возможны конфликты при множестве запросов, следует поставить на очередь?
        if ($this->client->exists($countryCode)) {
            $this->client->incr($countryCode);

            return;
        }

        $this->client->set($countryCode, 1);
    }
}
