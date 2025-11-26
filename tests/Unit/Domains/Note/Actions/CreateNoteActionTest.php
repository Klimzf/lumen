<?php

namespace Tests\Unit\Domains\Note\Actions;

use App\Domains\Note\Actions\CreateNoteAction;
use App\Domains\Note\DTOs\NoteCreateData;
use App\Domains\Note\Enums\NoteImportance;
use App\Domains\Note\Exceptions\NoteNotFoundException;
use App\Domains\Note\Models\Note;
use App\Domains\Note\Interfaces\NoteRepositoryInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @covers \App\Domains\Note\Actions\CreateNoteAction
 */
class CreateNoteActionTest extends TestCase
{
    use RefreshDatabase;

    private CreateNoteAction $action;
    private NoteRepositoryInterface $repository;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->mock(NoteRepositoryInterface::class);
        $this->action = new CreateNoteAction($this->repository);
        $this->user = User::factory()->create();
    }

    public function test_it_creates_note_with_tags()
    {
        $data = new NoteCreateData(
            title: "Первая записка",
            content: "Содержимое первой записки",
            importance: NoteImportance::HIGH,
            tagNames: collect(['work', 'urgent'])
        );

        $this->repository->shouldReceive('create')
            ->with([
                "title" => "Первая записка",
                "content" => "Содержимое первой записки",
                "importance" => 'high',
            ], $this->user, ['work', 'urgent'])
            ->once();

        $this->action->execute($data, $this->user);
    }

    public function test_it_trims_title_and_content()
    {
        $data = new NoteCreateData(
            title: '  Заголовок с пробелами  ',
            content: "  Содержимое\nс пробелами  ",
            importance: NoteImportance::MEDIUM,
            tagNames: collect(['test'])
        );

        $this->repository->shouldReceive('create')
            ->with([
                'title' => 'Заголовок с пробелами',
                'content' => "Содержимое\nс пробелами",
                'importance' => 'medium'
            ], $this->user, ['test'])
            ->once();

        $this->action->execute($data, $this->user);
    }

    /**
     * @dataProvider invalidImportanceProvider
     */
    public function test_it_validates_importance($invalidValue)
    {
        $this->expectException(\ValueError::class);

        new NoteCreateData(
            title: "test",
            content: "test",
            importance: NoteImportance::from($invalidValue),
            tagNames: collect()
        );
    }

    public static function invalidImportanceProvider(): array
    {
        return [
            ['invalid'],
            ['critical'],
            [''],
            [null]
        ];
    }
}


