<?php

namespace App\Domains\Tag\Repositories;

use App\Domains\Tag\Interfaces\TagRepositoryInterface;
use App\Domains\Tag\Models\Tag;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\str;

class EloquentTagRepository implements TagRepositoryInterface
{
    public function create(array $data, User $user): Tag
    {
        return $user->tags()->create([
            'id' => Str::uuid(),
            ...$data
        ]);
    }

    public function update(Tag $tag, array $data): Tag
    {
        $tag->update($data);
        return $tag;
    }

    public function delete(Tag $tag): Tag
    {
        $tag->delete();
    }

    public function findByName(string $name, User $user): Tag
    {
        return $user->tags()->where('name', $name)->first();
    }

    public function findById(int $id, User $user): Tag
    {
        return $user->tags()->where('id', $id)->first();
    }

    public function listForUser(User $user): Collection
    {
        return $user->tags()
            ->orderBy('name')
            ->get();
    }

}
