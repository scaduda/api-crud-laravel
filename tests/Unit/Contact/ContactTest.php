<?php

use App\Models\Contact;
use Database\Factories\ContactFactory;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\deleteJson;

const BASE_URL_CONTACT = 'api/v1/contact';

it(
    'Create contact',
    function () {
        $contact = Contact::factory()->raw();
        postJson(BASE_URL_CONTACT, $contact)->assertStatus(201);
    });

it(
    'Fail - Create contact',
    function () {
        postJson(BASE_URL_CONTACT, [])->assertStatus(422);
    });

it(
    'Index contact',
    function () {
        Contact::factory()->create();
        getJson(BASE_URL_CONTACT)->assertStatus(200);
    });

it(
    'Show contact',
    function () {
        $contact = Contact::factory()->create();
        getJson(BASE_URL_CONTACT."/{$contact->id}")->assertStatus(200);
    });

it(
    'Fail - Show contact',
    function () {
        getJson(BASE_URL_CONTACT."/123")->assertStatus(400);
    });

it(
    'Update contact',
    function () {
        $contact = Contact::factory()->create();
        $faker = new ContactFactory();
        $faker_phone_number = $faker->raw();
        $change = ['phone_number' => $faker_phone_number['phone_number']];
        putJson(BASE_URL_CONTACT."/{$contact->id}", $change)->assertStatus(200);
    });

it(
    'Delete contact',
    function () {
        $contact = Contact::factory()->create();
        deleteJson(BASE_URL_CONTACT."/{$contact->id}")->assertStatus(200);
    });
