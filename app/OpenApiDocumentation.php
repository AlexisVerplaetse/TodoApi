<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Todo API',
    description: 'API Laravel pour gerer les todos et les events.'
)]
#[OA\Server(url: '/', description: 'Serveur local ou courant')]
#[OA\Server(url: 'https://todoapi-f9xq.onrender.com', description: 'Serveur de test Render')]
#[OA\SecurityScheme(
    securityScheme: 'api_key',
    type: 'apiKey',
    description: 'Cle API definie dans la variable d environnement API_KEY.',
    name: 'X-API-KEY',
    in: 'header'
)]
#[OA\Schema(
    schema: 'Todo',
    required: ['id', 'title', 'fait', 'id_user'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'Apprendre Laravel'),
        new OA\Property(property: 'fait', type: 'integer', nullable: true, example: 0),
        new OA\Property(property: 'id_user', type: 'integer', nullable: true, example: 1),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'TodoInput',
    required: ['title', 'id_user'],
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, example: 'Apprendre Laravel'),
        new OA\Property(property: 'fait', type: 'integer', nullable: true, example: 0),
        new OA\Property(property: 'id_user', type: 'integer', example: 1),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'TodoUpdateInput',
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, example: 'Apprendre Laravel'),
        new OA\Property(property: 'fait', type: 'integer', nullable: true, example: 1),
        new OA\Property(property: 'id_user', type: 'integer', example: 1),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'Event',
    required: ['id', 'title', 'id_user'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'Revision'),
        new OA\Property(property: 'startHour', type: 'number', format: 'float', nullable: true, example: 9),
        new OA\Property(property: 'endHour', type: 'number', format: 'float', nullable: true, example: 11),
        new OA\Property(property: 'colorValue', type: 'string', nullable: true, example: '#3b82f6'),
        new OA\Property(property: 'date_event', type: 'string', format: 'date', nullable: true, example: '2026-05-06'),
        new OA\Property(property: 'id_user', type: 'integer', nullable: true, example: 1),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'EventInput',
    required: ['title', 'id_user'],
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, example: 'Revision'),
        new OA\Property(property: 'startHour', type: 'number', format: 'float', nullable: true, example: 9),
        new OA\Property(property: 'endHour', type: 'number', format: 'float', nullable: true, example: 11),
        new OA\Property(property: 'colorValue', type: 'string', maxLength: 255, nullable: true, example: '#3b82f6'),
        new OA\Property(property: 'date_event', type: 'string', format: 'date', nullable: true, example: '2026-05-06'),
        new OA\Property(property: 'id_user', type: 'integer', example: 1),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'EventUpdateInput',
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, example: 'Revision'),
        new OA\Property(property: 'startHour', type: 'number', format: 'float', nullable: true, example: 9),
        new OA\Property(property: 'endHour', type: 'number', format: 'float', nullable: true, example: 11),
        new OA\Property(property: 'colorValue', type: 'string', maxLength: 255, nullable: true, example: '#3b82f6'),
        new OA\Property(property: 'date_event', type: 'string', format: 'date', nullable: true, example: '2026-05-06'),
        new OA\Property(property: 'id_user', type: 'integer', example: 1),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'User',
    required: ['id', 'email', 'mdp'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'email', type: 'string', maxLength: 255, example: 'user@example.com'),
        new OA\Property(property: 'mdp', type: 'string', maxLength: 255, example: 'motdepasse'),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'UserInput',
    required: ['email', 'mdp'],
    properties: [
        new OA\Property(property: 'email', type: 'string', maxLength: 255, example: 'user@example.com'),
        new OA\Property(property: 'mdp', type: 'string', maxLength: 255, example: 'motdepasse'),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'UserUpdateInput',
    properties: [
        new OA\Property(property: 'email', type: 'string', maxLength: 255, example: 'user@example.com'),
        new OA\Property(property: 'mdp', type: 'string', maxLength: 255, example: 'nouveau-motdepasse'),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'ErrorResponse',
    properties: [
        new OA\Property(property: 'message', type: 'string', example: 'Invalid API key.'),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'ValidationErrorResponse',
    properties: [
        new OA\Property(property: 'message', type: 'string', example: 'The title field is required.'),
        new OA\Property(
            property: 'errors',
            type: 'object',
            example: ['title' => ['The title field is required.']]
        ),
    ],
    type: 'object'
)]
class OpenApiDocumentation
{
    #[OA\Get(
        path: '/api/todos',
        summary: 'Lister les todos',
        security: [['api_key' => []]],
        tags: ['Todos'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Liste des todos',
                content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Todo'))
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function listTodos(): void
    {
    }

    #[OA\Post(
        path: '/api/todos',
        summary: 'Creer un todo',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/TodoInput')
        ),
        tags: ['Todos'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Todo cree',
                content: new OA\JsonContent(ref: '#/components/schemas/Todo')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function createTodo(): void
    {
    }

    #[OA\Get(
        path: '/api/todos/{todo}',
        summary: 'Afficher un todo',
        security: [['api_key' => []]],
        tags: ['Todos'],
        parameters: [
            new OA\Parameter(
                name: 'todo',
                description: 'Identifiant du todo',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Todo trouve',
                content: new OA\JsonContent(ref: '#/components/schemas/Todo')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Todo introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function showTodo(): void
    {
    }

    #[OA\Put(
        path: '/api/todos/{todo}',
        summary: 'Modifier un todo',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/TodoUpdateInput')
        ),
        tags: ['Todos'],
        parameters: [
            new OA\Parameter(
                name: 'todo',
                description: 'Identifiant du todo',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Todo modifie',
                content: new OA\JsonContent(ref: '#/components/schemas/Todo')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Todo introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function replaceTodo(): void
    {
    }

    #[OA\Patch(
        path: '/api/todos/{todo}',
        summary: 'Modifier partiellement un todo',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/TodoUpdateInput')
        ),
        tags: ['Todos'],
        parameters: [
            new OA\Parameter(
                name: 'todo',
                description: 'Identifiant du todo',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Todo modifie',
                content: new OA\JsonContent(ref: '#/components/schemas/Todo')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Todo introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function updateTodo(): void
    {
    }

    #[OA\Delete(
        path: '/api/todos/{todo}',
        summary: 'Supprimer un todo',
        security: [['api_key' => []]],
        tags: ['Todos'],
        parameters: [
            new OA\Parameter(
                name: 'todo',
                description: 'Identifiant du todo',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Todo supprime'),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Todo introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function deleteTodo(): void
    {
    }

    #[OA\Get(
        path: '/api/events',
        summary: 'Lister les events',
        security: [['api_key' => []]],
        tags: ['Events'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Liste des events',
                content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Event'))
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function listEvents(): void
    {
    }

    #[OA\Post(
        path: '/api/events',
        summary: 'Creer un event',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/EventInput')
        ),
        tags: ['Events'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Event cree',
                content: new OA\JsonContent(ref: '#/components/schemas/Event')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function createEvent(): void
    {
    }

    #[OA\Get(
        path: '/api/events/{event}',
        summary: 'Afficher un event',
        security: [['api_key' => []]],
        tags: ['Events'],
        parameters: [
            new OA\Parameter(
                name: 'event',
                description: 'Identifiant de l event',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Event trouve',
                content: new OA\JsonContent(ref: '#/components/schemas/Event')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Event introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function showEvent(): void
    {
    }

    #[OA\Put(
        path: '/api/events/{event}',
        summary: 'Modifier un event',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/EventUpdateInput')
        ),
        tags: ['Events'],
        parameters: [
            new OA\Parameter(
                name: 'event',
                description: 'Identifiant de l event',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Event modifie',
                content: new OA\JsonContent(ref: '#/components/schemas/Event')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Event introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function replaceEvent(): void
    {
    }

    #[OA\Patch(
        path: '/api/events/{event}',
        summary: 'Modifier partiellement un event',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/EventUpdateInput')
        ),
        tags: ['Events'],
        parameters: [
            new OA\Parameter(
                name: 'event',
                description: 'Identifiant de l event',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Event modifie',
                content: new OA\JsonContent(ref: '#/components/schemas/Event')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Event introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function updateEvent(): void
    {
    }

    #[OA\Delete(
        path: '/api/events/{event}',
        summary: 'Supprimer un event',
        security: [['api_key' => []]],
        tags: ['Events'],
        parameters: [
            new OA\Parameter(
                name: 'event',
                description: 'Identifiant de l event',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Event supprime'),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Event introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function deleteEvent(): void
    {
    }

    #[OA\Get(
        path: '/api/user',
        summary: 'Lister les utilisateurs',
        security: [['api_key' => []]],
        tags: ['Users'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Liste des utilisateurs',
                content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/User'))
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function listUsers(): void
    {
    }

    #[OA\Post(
        path: '/api/user',
        summary: 'Creer un utilisateur',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UserInput')
        ),
        tags: ['Users'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Utilisateur cree',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function createUser(): void
    {
    }

    #[OA\Get(
        path: '/api/user/{user}',
        summary: 'Afficher un utilisateur',
        security: [['api_key' => []]],
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                description: 'Identifiant de l utilisateur',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Utilisateur trouve',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Utilisateur introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function showUser(): void
    {
    }

    #[OA\Put(
        path: '/api/user/{user}',
        summary: 'Modifier un utilisateur',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UserUpdateInput')
        ),
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                description: 'Identifiant de l utilisateur',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Utilisateur modifie',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Utilisateur introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function replaceUser(): void
    {
    }

    #[OA\Patch(
        path: '/api/user/{user}',
        summary: 'Modifier partiellement un utilisateur',
        security: [['api_key' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UserUpdateInput')
        ),
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                description: 'Identifiant de l utilisateur',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Utilisateur modifie',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Utilisateur introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Erreur de validation',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
            ),
        ]
    )]
    public function updateUser(): void
    {
    }

    #[OA\Delete(
        path: '/api/user/{user}',
        summary: 'Supprimer un utilisateur',
        security: [['api_key' => []]],
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                description: 'Identifiant de l utilisateur',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Utilisateur supprime'),
            new OA\Response(
                response: 401,
                description: 'Cle API invalide',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Utilisateur introuvable',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function deleteUser(): void
    {
    }
}
