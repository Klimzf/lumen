<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Domains\Note\Actions\CreateNoteAction;
use App\Domains\Note\Actions\UpdateNoteAction;
use App\Domains\Note\Actions\ListNotesForUserAction;
use App\Domains\Note\DTOs\NoteCreateData;
use App\Domains\Note\DTOs\NoteUpdateData;
use App\Domains\Note\DTOs\NoteListItem;
use App\Domains\Note\Enums\NoteImportance;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(
        private ListNotesForUserAction $listNotesForUserAction,
        private CreateNoteAction       $createNoteAction,
        private UpdateNoteAction       $updateNoteAction,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = $this->listNotesForUserAction->execute(
            user: auth()->user(),
            includeArchived: \request('archived') === 'true'
        );

        return Inertia::render('Notes/Index', [
            'notes' => $notes,
            'filters' => [
                'search' => \request('search', ''),
                'importance' => \request('importance', ''),
                'tag' => \request('tag', ''),
                'archived' => \request('archived', false) === 'true',
            ],
            'importanceOptions' => $this->getImportanceOptions(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Notes/Create', [
            'importanceOptions' => $this->getImportanceOptions(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = NoteCreateData::fromArray($request->validated());

        $this->createNoteAction->execute($data, auth()->user());

        return redirect()->route('notes.index')
            ->with('success', 'Записка успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $note = auth()->user()->notes()->findOrFail($id);

        return Inertia::render('Notes/Edit', [
            'note' => $note,
            'importanceOptions' => $this->getImportanceOptions(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = auth()->user()->notes()->findOrFail($id);

        $data = NoteUpdateData::fromArray($request->validated());

        $this->updateNoteAction->execute($note->id, $data, auth()->user());

        return redirect()->route('notes.index')
            ->with('success', 'Записка успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getImportanceOptions(): array
    {
        return collect(NoteImportance::cases())->map(function (NoteImportance $noteImportance) {
            return [
                'value' => $noteImportance->value,
                'label' => $noteImportance->label(),
                'color' => $noteImportance->color(),
            ];
        })->toArray();
    }
}
