<?php

namespace App\Domains\Tag\Actions;

use App\Domains\Tag\DTOs\TagCreateData;
use App\Domains\Tag\Repositories\EloquentTagRepository;
use App\Models\User;

class CreateTagAction
{
    public function __construct(
        private EloquentTagRepository $repository,
    ) {}

    public function execute(TagCreateData $data, User $user): void
    {
        $this->repository->create([
            'name' => $data->name,
        ],
        user: $user
    );
    }
}
