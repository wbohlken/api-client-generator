<?php

declare(strict_types=1);

/*
 * This file was generated by docler-labs/api-client-generator.
 *
 * Do not edit it manually.
 */

namespace Test\Schema\Mapper;

use Test\Schema\ItemCollection;

class ItemCollectionMapper implements SchemaMapperInterface
{
    public function __construct(private ItemMapper $itemMapper)
    {
    }

    public function toSchema(array $payload): ItemCollection
    {
        $items = [];
        foreach ($payload as $payloadItem) {
            $items[] = $this->itemMapper->toSchema($payloadItem);
        }

        return new ItemCollection(...$items);
    }
}
