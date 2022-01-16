<?php

namespace App\Services\Contact\Interfaces;

use App\Models\Contact;

interface IContactService
{
    public function index();

    public function show(string $id): Contact;

    public function store(array $contact): Contact;

    public function update(string $id, array $changes): Contact;

    public function destroy(string $id);
}
