<?php

namespace App\Services\Contact;

use App\Models\Contact;
use App\Services\Contact\Interfaces\IContactService;
use Exception;
use Illuminate\Support\Facades\DB;

class ContactService implements IContactService
{
    public function index()
    {
        return Contact::all();
    }

    public function show(string $id): Contact
    {
        return Contact::findOrFail($id);
    }

    /**
     * @throws Exception
     */
    public function store(array $contact): Contact
    {
        DB::beginTransaction();
        try {
            $created_contact = Contact::create($contact);
            DB::commit();
            return $created_contact;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function update(string $id, array $changes): Contact
    {
        DB::beginTransaction();
        try {
            $contact = Contact::findOrFail($id);
            $contact->update($changes);
            DB::commit();
            return $contact;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function destroy(string $id)
    {
        $contact =  Contact::destroy($id);
        if (empty($contact)){
            return ['No record found'];
        }
        return ['Successfully deleted'];
    }

}
