<?php

namespace App\Domains\Note\Models;

use App\Domains\Note\Enums\NoteImportance;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content',
        'importance',
        'is_archived'
    ];

    protected $casts = [
        'is_archived' => 'boolean',
        'importance' => NoteImportance::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value)
        );
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value)
        );
    }
}
