<?php

declare(strict_types=1);

/*
 * This file was generated by docler-labs/api-client-generator.
 *
 * Do not edit it manually.
 */

namespace Test\Request;

use Test\Schema\PatchAnotherSubResourceRequestBody;

class PatchAnotherSubResourceRequest implements RequestInterface
{
    private string $contentType = 'application/json';

    public function __construct(private PatchAnotherSubResourceRequestBody $patchAnotherSubResourceRequestBody, private string $apiKey)
    {
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getRoute(): string
    {
        return 'v1/resources/sub/resource/{resourceId}';
    }

    public function getQueryParameters(): array
    {
        return [];
    }

    public function getRawQueryParameters(): array
    {
        return [];
    }

    public function getCookies(): array
    {
        return ['api_key' => $this->apiKey];
    }

    public function getHeaders(): array
    {
        return ['Content-Type' => $this->contentType];
    }

    /**
     * @return PatchAnotherSubResourceRequestBody
     */
    public function getBody()
    {
        return $this->patchAnotherSubResourceRequestBody;
    }
}
