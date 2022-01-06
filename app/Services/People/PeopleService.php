<?php

namespace App\Services\People;

use App\Models\People;
use App\Services\People\Interfaces\IPeopleService;
use Exception;
use Illuminate\Support\Facades\DB;

class PeopleService implements IPeopleService
{
    public function index(): array
    {
        return People::all();
    }

    public function show(string $id): People
    {
        return People::findOrFail($id);
    }

    /**
     * @throws Exception
     */
    public function store(array $people): People
    {
        DB::beginTransaction();
        try {
            $created_people = People::create($people);
            DB::commit();
            return $created_people;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $changes): People
    {
        DB::beginTransaction();
        try {
            $people = People::findOrFail($id);
            $people->update($changes);
            DB::commit();
            return $people;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function destroy(string $id)
    {
        return People::destroy($id);
    }

}
