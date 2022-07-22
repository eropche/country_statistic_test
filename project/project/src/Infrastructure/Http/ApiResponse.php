<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    /**
     * @var int|string
     */
    protected $encodingOptions = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

    /**
     * @param mixed        $data
     * @param array<mixed> $headers
     */
    public function __construct($data = null, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($data, $status, $headers, $json);

        if ($data === null) {
            $json ? $this->setJson((string) $data) : $this->setData($data);
        }
    }

    /**
     * @param mixed $data
     */
    public function setData($data = []): static
    {
        $responseData = [
            'data' => null,
            'error' => null,
            'error_details' => null,
        ];

        if (!\is_array($data)) {
            $responseData['data'] = $data;

            return parent::setData($responseData);
        }

        $data = json_decode((string) json_encode($data), true);

        if (isset($data['error'])) {
            $responseData = array_merge($responseData, $data);
        } else {
            $responseData['data'] = $data;
        }

        return parent::setData($responseData);
    }
}
