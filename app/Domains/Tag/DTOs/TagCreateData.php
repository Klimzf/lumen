<?php

namespace App\Domains\Tag\DTOs;

class TagCreateData
{
    public function __construct(
        public string $name,
        public string $user_id
    ) {
        $this->name = strtolower(trim($name));
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
        );
    }
}
