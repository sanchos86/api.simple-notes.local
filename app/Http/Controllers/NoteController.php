<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Note;
use App\Services\NoteService;
use App\Http\Resources\NoteResource;
use App\Http\Requests\Note\EditNoteRequest;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\Note\CreateNoteRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NoteController extends Controller
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $notes = $this->noteService->getList($request);
        return NoteResource::collection($notes);
    }

    /**
     * @param CreateNoteRequest $request
     * @return NoteResource
     */
    public function store(CreateNoteRequest $request): NoteResource
    {
        $note = $this->noteService->store($request);
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
        $note = $this->noteService->update($request, $note);
        return new NoteResource($note);
    }

    /**
     * @param Note $note
     * @return JsonResponse
     */
    public function destroy(Note $note): JsonResponse
    {
        try {
            $this->noteService->destroy($note);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
