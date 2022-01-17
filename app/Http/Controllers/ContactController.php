<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Services\Contact\Interfaces\IContactService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

/**
 * @group Contact
 *
 */

class ContactController extends Controller
{
    public function __construct(private IContactService $service)
    {
    }

    /**
     * List contact
     *
     * @apiResourceCollection  200 App\Http\Resources\ContactResource
     * @apiResourceModel App\Models\Contact
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function index()
    {
        try {
            return new ContactResource($this->service->index());
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Search contact
     *
     * @apiResourceCollection  200 App\Http\Resources\ContactResource
     * @apiResourceModel App\Models\Contact
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function show(string $id)
    {
        try {
            return new ContactResource($this->service->show($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Create contact
     *
     * @apiResourceCollection  201 App\Http\Resources\ContactResource
     * @apiResourceModel App\Models\Contact
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=422 responses/mensagem.erro.json
     *
     */


    public function store(StoreContactRequest $request)
    {
        try {
            return (new ContactResource($this->service->store($request->all())))
                ->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Update contact
     *
     * @apiResourceCollection  200 App\Http\Resources\ContactResource
     * @apiResourceModel App\Models\Contact
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function update(string $id, UpdateContactRequest $request)
    {
        try {
            return (new ContactResource($this->service->update($id, $request->all())));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete contact
     *
     * @apiResourceCollection  200 App\Http\Resources\ContactResource
     * @apiResourceModel App\Models\Contact
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function destroy(string $id)
    {
        try {
            return new ContactResource($this->service->destroy($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
