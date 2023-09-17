<?php

declare(strict_types=1);

/*
 * This file was generated by docler-labs/api-client-generator.
 *
 * Do not edit it manually.
 */

namespace OpenApi\PetStoreClient\Schema;

use JsonSerializable;

class Pet implements SerializableInterface, JsonSerializable
{
    public const STATUS_AVAILABLE = 'available';

    public const STATUS_PENDING = 'pending';

    public const STATUS_SOLD = 'sold';

    private ?int $id = null;

    private string $name;

    private ?Category $category = null;

    private array $photoUrls;

    private ?TagCollection $tags = null;

    private ?string $status = null;

    private ?bool $chipped = null;

    private array $optionalPropertyChanged = ['id' => false, 'category' => false, 'tags' => false, 'status' => false, 'chipped' => false];

    /**
     * @param string[] $photoUrls
     */
    public function __construct(string $name, array $photoUrls)
    {
        $this->name      = $name;
        $this->photoUrls = $photoUrls;
    }

    public function setId(int $id): self
    {
        $this->id                            = $id;
        $this->optionalPropertyChanged['id'] = true;

        return $this;
    }

    public function setCategory(Category $category): self
    {
        $this->category                            = $category;
        $this->optionalPropertyChanged['category'] = true;

        return $this;
    }

    public function setTags(TagCollection $tags): self
    {
        $this->tags                            = $tags;
        $this->optionalPropertyChanged['tags'] = true;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status                            = $status;
        $this->optionalPropertyChanged['status'] = true;

        return $this;
    }

    public function setChipped(?bool $chipped): self
    {
        $this->chipped                            = $chipped;
        $this->optionalPropertyChanged['chipped'] = true;

        return $this;
    }

    public function hasId(): bool
    {
        return $this->optionalPropertyChanged['id'];
    }

    public function hasCategory(): bool
    {
        return $this->optionalPropertyChanged['category'];
    }

    public function hasTags(): bool
    {
        return $this->optionalPropertyChanged['tags'];
    }

    public function hasStatus(): bool
    {
        return $this->optionalPropertyChanged['status'];
    }

    public function hasChipped(): bool
    {
        return $this->optionalPropertyChanged['chipped'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @return string[]
     */
    public function getPhotoUrls(): array
    {
        return $this->photoUrls;
    }

    public function getTags(): ?TagCollection
    {
        return $this->tags;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getChipped(): ?bool
    {
        return $this->chipped;
    }

    public function toArray(): array
    {
        $fields = [];
        if ($this->hasId()) {
            $fields['id'] = $this->id;
        }
        $fields['name'] = $this->name;
        if ($this->hasCategory()) {
            $fields['category'] = $this->category->toArray();
        }
        $fields['photoUrls'] = $this->photoUrls;
        if ($this->hasTags()) {
            $fields['tags'] = $this->tags->toArray();
        }
        if ($this->hasStatus()) {
            $fields['status'] = $this->status;
        }
        if ($this->hasChipped()) {
            $fields['chipped'] = $this->chipped;
        }

        return $fields;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}