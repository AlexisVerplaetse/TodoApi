<?php

namespace Tests\Feature;

use Tests\TestCase;

class SwaggerDocumentationTest extends TestCase
{
    public function test_swagger_documentation_page_is_available(): void
    {
        $this->get('/api/docs')
            ->assertOk()
            ->assertSee('swagger-ui', false);
    }
}
