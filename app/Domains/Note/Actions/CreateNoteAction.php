<?php

namespace App\Domains\Note\Actions;

use App\Domains\Note\DTOs\NoteCreateData;
use App\Domains\Note\Interfaces\NoteRepositoryInterface;
use App\Models\User;

class CreateNoteAction
{
    public function __construct(private NoteRepositoryInterface $noteRepository) {}

    public function execute(NoteCreateData $data, User $user): void
    {
        $this->noteRepository->create(
            data: [
                'title' => $data->title,
                'content' => $data->content,
                'importance' => $data->importance->value,
            ],
            user: $user,
            tagNames: $data->tagNames->toArray(),
        );
    }
}
