<?php

namespace App\Domains\Note\Actions;

use App\Domains\Note\DTOs\NoteListItem;
use App\Domains\Note\Interfaces\NoteRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ListNotesForUserAction
{
    public function __construct(
        private NoteRepositoryInterface $repository
    ) {}

    public function execute(User $user, bool $includeArchived = false): Collection
    {
        return $this->repository->listForUser($user, $includeArchived)
            ->map(fn ($note) => new NoteListItem(
                id: $note->id,
                title: $note->title,
                excerpt: Str::limit(strip_tags($note->content), 100),
                importance: $note->importance,
                is_archived: $note->is_archived,
                tags: $note->tags->map(fn ($tag) => $tag->name),
                created_at: $note->created_at,
                updated_at: $note->updated_at
            ));
    }
}

