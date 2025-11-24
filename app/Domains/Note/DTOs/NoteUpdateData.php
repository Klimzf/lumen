<?php

namespace App\Domains\Note\DTOs;

use App\Domains\Note\Enums\NoteImportance;
use Illuminate\Support\Collection;

class NoteUpdateData
{
    public function __construct(
        public ?string $title = null,
        public ?string $content = null,
        public ?NoteImportance $importance = null,
        public ?bool $is_archived = null,
        public ?Collection $tagNames = null,
    )
    {
        if ($this->tagNames) {
            $this->tagNames = $this->tagNames->map(fn($name) => strtolower(trim($name)));
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'] ?? null,
            content: $data['content'] ?? null,
            importance: isset($data['importance']) ? NoteImportance::from($data['importance']) : null,
            is_archived: $data['is_archived'] ?? null,
            tagNames: isset($data['tags']) ? collect($data['tags']) : null
        );
    }
}
