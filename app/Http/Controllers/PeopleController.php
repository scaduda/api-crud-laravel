<?php

namespace App\Http\Controllers;


use App\Http\Requests\People\StorePeopleRequest;
use App\Http\Requests\People\UpdatePeopleRequest;
use App\Http\Resources\PeopleResource;
use App\Services\People\Interfaces\IPeopleService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * @group People
 *
 */

class PeopleController extends Controller
{
    public function __construct(private IPeopleService $service)
    {
    }

    /**
     * List people
     *
     * @apiResourceCollection  200 App\Http\Resources\PeopleResource
     * @apiResourceModel App\Models\People
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function index()
    {
        try {
            return new PeopleResource($this->service->index());
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Search people
     *
     * @apiResourceCollection  200 App\Http\Resources\PeopleResource
     * @apiResourceModel App\Models\People
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function show(string $id)
    {
        try {
            return new PeopleResource($this->service->show($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Create people
     *
     * @apiResourceCollection  201 App\Http\Resources\PeopleResource
     * @apiResourceModel App\Models\People
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=422 responses/mensagem.erro.json
     *
     */

    public function store(StorePeopleRequest $request)
    {
        try {
            return (new PeopleResource($this->service->store($request->all())))
                ->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (UnprocessableEntityHttpException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Update people
     *
     * @apiResourceCollection  200 App\Http\Resources\PeopleResource
     * @apiResourceModel App\Models\People
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function update(string $id, UpdatePeopleRequest $request)
    {
        try {
            return (new PeopleResource($this->service->update($id, $request->all())));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete people
     *
     * @apiResourceCollection  200 App\Http\Resources\PeopleResource
     * @apiResourceModel App\Models\People
     * @responseFile status=400 responses/mensagem.erro.json
     * @responseFile status=404 responses/mensagem.erro.json
     *
     */

    public function destroy(string $id)
    {
        try {
            return new PeopleResource($this->service->destroy($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
