<?php

declare(strict_types=1);

/*
 * This file was generated by docler-labs/api-client-generator.
 *
 * Do not edit it manually.
 */

namespace Test\Schema;

use JsonSerializable;
use stdClass;

class Item implements SerializableInterface, JsonSerializable
{
    private stdClass $data;

    public function __construct(array $data)
    {
        $this->data = (object) $data;
    }

    public function getData(): stdClass
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return (array) $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
