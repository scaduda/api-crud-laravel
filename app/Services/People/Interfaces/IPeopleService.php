<?php

namespace App\Services\People\Interfaces;

use App\Models\People;

interface IPeopleService
{
    public function index();

    public function show(string $id): People;

    public function store(array $people): People;

    public function update(string $id, array $changes): People;

    public function destroy(string $id);
}
