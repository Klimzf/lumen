<?php

namespace App\Domains\Note\DTOs;

use App\Domains\Note\Enums\NoteImportance;
use Illuminate\Support\Collection;

class NoteCreateData
{
    public function __construct(
        public string $title,
        public string $content,
        public NoteImportance $importance,
        public Collection $tagNames,
    ) {
        $this->tagNames = $this->tagNames->map(fn ($name) => strtolower(trim($name)));
        $this->title = trim($this->title);
        $this->content = trim($this->content);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            content: $data['content'],
            importance: NoteImportance::from($data['importance'] ?? 'medium'),
            tagNames: collect($data['tagNames'] ?? []),
        );
    }
}
