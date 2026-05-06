<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ApiKeyMiddlewareTest extends TestCase
{
    public function test_api_routes_require_api_key(): void
    {
        Config::set('services.api.key', 'secret-test-key');

        $this->getJson('/api/todos')
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Invalid API key.',
            ]);
    }

    public function test_api_routes_reject_invalid_api_key(): void
    {
        Config::set('services.api.key', 'secret-test-key');

        $this->withHeader('X-API-KEY', 'wrong-key')
            ->getJson('/api/todos')
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Invalid API key.',
            ]);
    }
}
