<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Todo API') }}</title>

        <style>
            body {
                margin: 0;
                min-height: 100vh;
                display: grid;
                place-items: center;
                font-family: Arial, sans-serif;
                background: #f6f7f9;
                color: #1f2937;
            }

            main {
                max-width: 720px;
                padding: 32px;
                text-align: center;
            }

            h1 {
                margin: 0 0 12px;
                font-size: 40px;
            }

            p {
                margin: 0 0 24px;
                color: #4b5563;
            }

            code {
                display: inline-block;
                margin: 6px;
                padding: 8px 12px;
                border-radius: 6px;
                background: #ffffff;
                border: 1px solid #e5e7eb;
            }
        </style>
    </head>
    <body>
        <main>
            <h1>Todo API</h1>
            <p>Application Laravel connectee a Supabase.</p>
            <code>GET /api/todos</code>
            <code>GET /api/events</code>
        </main>
    </body>
</html>
