<?php

namespace App\Domains\Tag\Models;

use App\Domains\Note\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(
            Note::class,
            'note_tag',
            'tag_id',
            'note_id'
        );
    }

    public function scopeWhereName($query, string $name)
    {
        return $query->where('name', strtolower(trim($name)));
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }
}
