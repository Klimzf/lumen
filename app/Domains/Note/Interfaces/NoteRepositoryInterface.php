<?php

namespace App\Domains\Note\Interfaces;

use App\Domains\Note\Models\Note;
use App\Models\User;
use Illuminate\Support\Collection;

interface NoteRepositoryInterface
{
    public function create(array $data, User $user, array $tagNames = []): Note;
    public function update(Note $note, array $data, ?array $tagNames = null): Note;
    public function delete(Note $note): void;
    public function findById(string $id, User $user): ?Note;
    public function listForUser(User $user, bool $includeArchived = false): Collection;
}
