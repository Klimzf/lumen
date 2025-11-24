<?php

namespace App\Domains\Tag\DTOs;

class TagUpdateData
{
    public function __construct(
        public ?string $name = null,
        public ?string $user_id = null,
    ) {
        if ($this->name) {
            $this->name = strtolower(trim($this->name));
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            user_id: $data['user_id'] ?? null
        );
    }
}
