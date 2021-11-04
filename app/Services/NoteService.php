<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Note\{CreateNoteRequest, EditNoteRequest};

class NoteService
{
    public function getList(Request $request): LengthAwarePaginator
    {
        $perPage = is_numeric($request->query('per-page')) ? intval($request->query('per-page')) : null;
        return Note::paginate($perPage);
    }

    /**
     * @param CreateNoteRequest $request
     * @return Note
     */
    public function store(CreateNoteRequest $request): Note
    {
        $params = $request->only([
            'priority',
            'description',
            'date',
            'category_id'
        ]);
        $note = Note::create($params);
        return $note->fresh();
    }

    /**
     * @param EditNoteRequest $request
     * @param Note $note
     * @return Note
     */
    public function update(EditNoteRequest $request, Note $note): Note
    {
        $params = $request->only([
            'priority',
            'description',
            'date',
            'category_id'
        ]);
        $params['completed'] = $request->boolean('completed');
        $note->update($params);
        return $note->fresh();
    }

    /**
     * @param Note $note
     * @throws
     */
    public function destroy(Note $note)
    {
        $note->delete();
    }
}
