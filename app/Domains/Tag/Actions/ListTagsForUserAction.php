<?php

namespace App\Domains\Tag\Actions;

use App\Domains\Tag\Repositories\EloquentTagRepository;
use App\Models\User;
use Illuminate\Support\Collection;

class ListTagsForUserAction
{
    public function __construct(
        private EloquentTagRepository $repository,
    ) {}

    public function execute(User $user): Collection
    {
        return $this->repository->listForUser($user);
    }
}
