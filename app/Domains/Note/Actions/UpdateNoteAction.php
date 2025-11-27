<?php

namespace App\Domains\Note\Actions;

use App\Domains\Note\DTOs\NoteUpdateData;
use App\Domains\Note\Exceptions\NoteNotFoundException;
use App\Domains\Note\Interfaces\NoteRepositoryInterface;
use App\Models\User;

class UpdateNoteAction
{
    public function __construct(private NoteRepositoryInterface $noteRepository) {}

    public function execute(string $noteId, NoteUpdateData $data, User $user): void
    {
        $note = $this->noteRepository->findById($noteId, $user);

        if (!$note) {
            throw new NoteNotFoundException();
        }

        $this->noteRepository->update(
            note: $note,
            data: array_filter([
                'title' => $data->title,
                'content' => $data->content,
                'importance' => $data->importance?->value,
                'is_archived' => $data->is_archived,
            ]),
            tagNames: $data->tagNames?->toArray()
        );
    }
}
