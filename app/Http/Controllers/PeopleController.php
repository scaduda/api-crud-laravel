<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;
use App\Http\Resources\PeopleResource;
use App\Services\People\Interfaces\IPeopleService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class PeopleController extends Controller
{
    public function __construct(private IPeopleService $service)
    {
    }

    public function index()
    {
        try {
            return new PeopleResource($this->service->index());
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

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

    public function store(StorePeopleRequest $request)
    {
        try {
            return (new PeopleResource($this->service->store($request->all())))
                ->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }

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
