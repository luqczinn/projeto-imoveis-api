<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Owner;
use Laravel\Sanctum\Sanctum;

uses( RefreshDatabase::class);

    /**
     * A basic feature test example.
     */

test('listar proprietarios', function () {
    authUser();
    Owner::factory()->count(3)->create();

    $response = $this->getJson('/api/owners');

    $response->assertOk();
    $response->assertJsonCount(3);
});

test('criar proprietario', function () {
    authUser();
    $data = [
        'name' => 'Lucas Silva',
        'email' => 'lucas@example.com',
        'phone' => '31999999999',
    ];

    $response = $this->postJson('/api/owners', $data);

    $response->assertCreated();
    $this->assertDatabaseHas('owners', $data);
});

test('mostrar proprietario por id', function () {
    authUser();
    $owner = Owner::factory()->create();

    $response = $this->getJson("/api/owners/{$owner->id}");

    $response->assertOk();
    $response->assertJsonFragment(['name' => $owner->name]);
});

test('atualizar proprietario', function () {
    authUser();
    $owner = Owner::factory()->create();

    $update = ['name' => 'Nome Atualizado'];

    $response = $this->putJson("/api/owners/{$owner->id}", $update);

    $response->assertOk();
    $this->assertDatabaseHas('owners', ['id' => $owner->id, 'name' => 'Nome Atualizado']);
});

test('deletar proprietario', function () {
    authUser();
    $owner = Owner::factory()->create();

    $response = $this->deleteJson("/api/owners/{$owner->id}");

    $response->assertOk();
    $this->assertDatabaseMissing('owners', ['id' => $owner->id]);
});