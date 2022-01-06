<?php

namespace App\Http\Controllers;



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

    }

    public function store(array $people)
    {

    }

    public function update(string $id, array $changes)
    {

    }

    public function destroy(string $id)
    {

    }
}
