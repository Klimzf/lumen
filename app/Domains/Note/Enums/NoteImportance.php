<?php

namespace App\Domains\Note\Enums;

enum NoteImportance: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Низкая',
            self::MEDIUM => 'Средняя',
            self::HIGH => 'Высокая',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::LOW => 'bg-gray-100 text-gray-800',
            self::MEDIUM => 'bg-yellow-100 text-yellow-800',
            self::HIGH => 'bg-red-100 text-red-800',
        };
    }
}
