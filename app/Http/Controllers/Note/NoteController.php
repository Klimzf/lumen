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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
