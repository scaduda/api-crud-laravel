<?php

use App\Models\People;
use Database\Factories\PeopleFactory;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\deleteJson;

const BASE_URL = 'api/v1/people';

it(
    'Create people',
    function () {
        $people = People::factory()->raw();
        postJson(BASE_URL, $people)->assertStatus(201);
    });

it(
    'Fail - Create people',
    function () {
        postJson(BASE_URL, [])->assertStatus(422);
    });

it(
    'Index people',
    function () {
        People::factory()->create();
        getJson(BASE_URL)->assertStatus(200);
    });

it(
    'Show people',
    function () {
        $people = People::factory()->create();
        getJson(BASE_URL."/{$people->id}")->assertStatus(200);
    });

it(
    'Fail - Show people',
    function () {
        getJson(BASE_URL."/123")->assertStatus(400);
    });

it(
    'Update people',
    function () {
        $people = People::factory()->create();
        $faker = new PeopleFactory();
        $faker_name = $faker->raw();
        $change = ['name' => $faker_name['name']];
        putJson(BASE_URL."/{$people->id}", $change)->assertStatus(200);
    });

it(
    'Delete people',
    function () {
        $people = People::factory()->create();
        deleteJson(BASE_URL."/{$people->id}")->assertStatus(200);
    });
