<?php

namespace App\Domains\Tag\Interfaces;

use App\Domains\Tag\Models\Tag;
use App\Models\User;
use Illuminate\Support\Collection;

interface TagRepositoryInterface
{
    public function create(array $data, User $user): Tag;
    public function update(Tag $tag, array $data): Tag;
    public function delete(Tag $tag): Tag;
    public function findByName(string $name, User $user): ?Tag;
    public function findById(int $id, User $user): ?Tag;
    public function listForUser (User $user): Collection;
}
