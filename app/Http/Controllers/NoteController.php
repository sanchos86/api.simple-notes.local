<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Http\Requests\Note\EditNoteRequest;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return NoteResource::collection(Note::paginate());
    }

    /**
     * @param CreateNoteRequest $request
     * @return NoteResource
     */
    public function store(CreateNoteRequest $request): NoteResource
    {
        $params = $request->only([
            'priority',
            'description',
            'date',
            'category_id'
        ]);
        $note = Note::create($params);
        $note = $note->fresh();
        return new NoteResource($note);
    }

    /**
     * @param Note $note
     * @return NoteResource
     */
    public function show(Note $note): NoteResource
    {
        return new NoteResource($note);
    }

    /**
     * @param EditNoteRequest $request
     * @param Note $note
     * @return NoteResource
     */
    public function update(EditNoteRequest $request, Note $note): NoteResource
    {
        $params = $request->only([
            'priority',
            'description',
            'date',
            'category_id'
        ]);
        $params['completed'] = $request->boolean('completed');
        $note->update($params);
        return new NoteResource($note);
    }

    /**
     * @param Note $note
     * @return JsonResponse
     * @throws
     */
    public function destroy(Note $note): JsonResponse
    {
        $note->delete();
        return response()->json([], 204);
    }
}
