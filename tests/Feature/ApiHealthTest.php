<?php

test('the application returns a json response from the root', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Cortex Core API',
        ]);
});

test('the health route returns a successful json response', function () {
    $response = $this->get('/api/health');

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'ok',
        ])
        ->assertJsonStructure([
            'status',
            'timestamp',
        ]);
});

test('it forces json response even if accept header is not set', function () {
    $response = $this->get('/', [
        'Accept' => 'text/html',
    ]);

    $response->assertHeader('Content-Type', 'application/json');
});
