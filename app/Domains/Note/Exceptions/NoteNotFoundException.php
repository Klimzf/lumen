<?php

namespace App\Domains\Note\Exceptions;

use Exception;

class NoteNotFoundException extends Exception
{
    public static function forId(string $id): self
    {
        return new self("Записка с ID {$id} не найдена");
    }
}
