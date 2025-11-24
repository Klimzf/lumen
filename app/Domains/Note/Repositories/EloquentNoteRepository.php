<?php

namespace App\Domains\Note\Repositories;

use App\Domains\Note\Exceptions\NoteNotFoundException;
use App\Domains\Note\Models\Note;
use App\Domains\Note\Models\Tag;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EloquentNoteRepository implements NoteRepositoryInterface
{
    public function create(array $data, User $user, array $tagNames = []): Note
    {
        return DB::transaction(function () use ($data, $user, $tagNames) {
            $note = $user->notes()->create([
                'id' => Str::uuid(),
                ...$data
            ]);

            $this->syncTags($note, $tagNames);
            return $note;
        });
    }

    public function update(Note $note, array $data, ?array $tagNames = null): Note
    {
        return DB::transaction (function () use ($note, $data, $tagNames) {
            $note->update($data);

            if ($tagNames !== null) {
                $this->syncTags($note, $tagNames);
            }

            return $note;
        });
    }

    public function delete(Note $note): void
    {
        $note->delete();
    }

    /**
     * @param string $id
     * @param \App\Models\User $user
     * @return \App\Domains\Note\Models\Note|null
     */
    public function findById(string $id, User $user): ?Note
    {
        return $user->notes()->find($id);
    }

    public function listForUser(User $user, bool $includeArchived = false): Collection
    {
        return $user->notes()
            ->when(!$includeArchived, fn($q) => $q->where('is_archived', false))
            ->with('tags')
            ->orderByDesc('updated_at')
            ->get();
    }

    public function syncTags(Note $note, array $tagNames): void
    {
        $tagIds = collect($tagNames)
            ->filter()
            ->map(function (string $name) use ($note) {
                $tag = $note->user->tags()->whereName($name)->first();
                if (!$tag) {
                    $tag = $note->user->tags()->create([
                        'id' => Str::uuid(),
                        'name' => strtolower(trim($name)),
                    ]);
                }
                return $tag->id;
            })
            ->toArray();

        $note->tags()->sync($tagIds);
    }
}
