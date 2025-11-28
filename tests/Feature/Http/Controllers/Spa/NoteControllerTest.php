<?php

namespace Tests\Feature\Http\Controllers\Spu\Note;

use App\Domains\Note\Actions\CreateNoteAction;
use App\Domains\Note\Actions\ListNotesForUserAction;
use App\Domains\Note\Actions\UpdateNoteAction;
use App\Domains\Note\DTOs\NoteCreateData;
use App\Domains\Note\DTOs\NoteUpdateData;
use App\Domains\Note\Enums\NoteImportance;
use App\Domains\Note\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{
    use RefreshDatabase;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_quest_cannot_access_notes()
    {
        $response = $this->get(route('notes.index'));
        $response->assertRedirect(route('login'));
    }
}
