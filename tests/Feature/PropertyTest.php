<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Owner;
use App\Models\Property;
use Laravel\Sanctum\Sanctum;

uses( RefreshDatabase::class);

    /**
     * A basic feature test example.
     */

test('listar imoveis', function () {
    authUser();
    Property::factory()->count(3)->create();

    $response = $this->getJson('/api/properties');

    $response->assertOk();
    $response->assertJsonCount(3);
});

test('criar imovel', function () {
    authUser();
    $owner = Owner::factory()->create();

    $data = [
        'title' => 'Casa Nova',
        'city' => 'Belo Horizonte',
        'price' => 350000,
        'owner_id' => $owner->id,
    ];

    $response = $this->postJson('/api/properties', $data);

    $response->assertCreated();
    $this->assertDatabaseHas('properties', $data);
});

test('mostrar imovel por id', function () {
    authUser();
    $property = Property::factory()->create();

    $response = $this->getJson("/api/properties/{$property->id}");

    $response->assertOk();
    $response->assertJsonFragment(['title' => $property->title]);
});

test('atualizar imovel', function () {
    authUser();
    $property = Property::factory()->create();

    $update = ['title' => 'Casa Atualizada'];

    $response = $this->putJson("/api/properties/{$property->id}", $update);

    $response->assertOk();
    $this->assertDatabaseHas('properties', ['id' => $property->id, 'title' => 'Casa Atualizada']);
});

test('deletar imovel', function () {
    authUser();
    $property = Property::factory()->create();

    $response = $this->deleteJson("/api/properties/{$property->id}");

    $response->assertOk();
    $this->assertDatabaseMissing('properties', ['id' => $property->id]);
});

test('filtrar imoveis por preco e cidade', function () {
    authUser();
    $owner = Owner::factory()->create();

    Property::factory()->create([
        'title' => 'Casa A',
        'city' => 'Belo Horizonte',
        'price' => 300000,
        'owner_id' => $owner->id,
    ]);

    Property::factory()->create([
        'title' => 'Casa B',
        'city' => 'Belo Horizonte',
        'price' => 600000,
        'owner_id' => $owner->id,
    ]);

    Property::factory()->create([
        'title' => 'Casa C',
        'city' => 'São Paulo',
        'price' => 500000,
        'owner_id' => $owner->id,
    ]);

    $response = $this->getJson('/api/properties/search/filter?city=Belo Horizonte&min_price=200000&max_price=500000');

    $response->assertOk();
    $response->assertJsonCount(2);
    $response->assertJsonFragment(['title' => 'Casa A']);
});