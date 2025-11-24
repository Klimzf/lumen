<?php

namespace App\Domains\Note\DTOs;

use App\Domains\Note\Enums\NoteImportance;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class NoteListItem
{
    public function __construct(
        public string $id,
        public string $title,
        public string $excerpt,
        public NoteImportance $importance,
        public bool $is_archived,
        public Collection $tags,
        public Carbon $created_at,
        public Carbon $updated_at,
    ) {}
}
