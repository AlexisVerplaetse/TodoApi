<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
    <img src="https://img.shields.io/badge/API-Todos%20%26%20Events-111827?style=for-the-badge" alt="Todo API">
    <img src="https://img.shields.io/badge/Database-Supabase-3ECF8E?style=for-the-badge&logo=supabase&logoColor=white" alt="Supabase">
</p>

<h1 align="center">Todo API</h1>

<p align="center">
    API Laravel connectee a Supabase pour gerer des todos et des events.
</p>

---

## Demarrage

```bash
php artisan serve
```

URL locale par defaut :

```text
http://127.0.0.1:8000
```

## Deploiement Render avec Docker

Le projet contient un `Dockerfile` pret pour Render.

Dans Render :

```text
New Web Service -> Deploy from Dockerfile
```

Si Render affiche une erreur du style `command start was not found`, le service a probablement ete cree avec le runtime Node au lieu de Docker.

Verifiez dans Render :

```text
Runtime / Language: Docker
Dockerfile Path: ./Dockerfile
Docker Command: vide
```

Le fichier `render.yaml` peut aussi etre utilise comme Blueprint Render pour forcer le runtime Docker.

Variables d'environnement a definir dans Render :

```env
APP_NAME=TodoApi
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:...
APP_URL=https://votre-api.onrender.com

API_KEY=votre-cle-api

DB_CONNECTION=pgsql
DB_HOST=...
DB_PORT=5432
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...
```

Pour generer une cle `APP_KEY` :

```bash
php artisan key:generate --show
```

## Securite

Toutes les routes API demandent une cle API dans le header HTTP :

```text
X-API-KEY: votre-cle-api
```

La cle est definie dans le fichier `.env` :

```env
API_KEY=votre-cle-api
```

## Routes API

Toutes les routes API sont prefixees par :

```text
/api
```

<table>
    <thead>
        <tr>
            <th align="left">Ressource</th>
            <th align="left">Methode</th>
            <th align="left">Route</th>
            <th align="left">Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Todos</strong></td>
            <td><code>GET</code></td>
            <td><code>/api/todos</code></td>
            <td>Recupere la liste des todos.</td>
        </tr>
        <tr>
            <td><strong>Todos</strong></td>
            <td><code>POST</code></td>
            <td><code>/api/todos</code></td>
            <td>Cree un nouveau todo.</td>
        </tr>
        <tr>
            <td><strong>Todos</strong></td>
            <td><code>GET</code></td>
            <td><code>/api/todos/{id}</code></td>
            <td>Recupere un todo par son identifiant.</td>
        </tr>
        <tr>
            <td><strong>Todos</strong></td>
            <td><code>PUT</code> / <code>PATCH</code></td>
            <td><code>/api/todos/{id}</code></td>
            <td>Modifie un todo existant.</td>
        </tr>
        <tr>
            <td><strong>Todos</strong></td>
            <td><code>DELETE</code></td>
            <td><code>/api/todos/{id}</code></td>
            <td>Supprime un todo.</td>
        </tr>
        <tr>
            <td><strong>Events</strong></td>
            <td><code>GET</code></td>
            <td><code>/api/events</code></td>
            <td>Recupere la liste des events.</td>
        </tr>
        <tr>
            <td><strong>Events</strong></td>
            <td><code>POST</code></td>
            <td><code>/api/events</code></td>
            <td>Cree un nouvel event.</td>
        </tr>
        <tr>
            <td><strong>Events</strong></td>
            <td><code>GET</code></td>
            <td><code>/api/events/{id}</code></td>
            <td>Recupere un event par son identifiant.</td>
        </tr>
        <tr>
            <td><strong>Events</strong></td>
            <td><code>PUT</code> / <code>PATCH</code></td>
            <td><code>/api/events/{id}</code></td>
            <td>Modifie un event existant.</td>
        </tr>
        <tr>
            <td><strong>Events</strong></td>
            <td><code>DELETE</code></td>
            <td><code>/api/events/{id}</code></td>
            <td>Supprime un event.</td>
        </tr>
    </tbody>
</table>

## Exemples

### Creer un todo

```bash
curl -X POST http://127.0.0.1:8000/api/todos \
  -H "Content-Type: application/json" \
  -H "X-API-KEY: votre-cle-api" \
  -d "{\"title\":\"Apprendre Laravel\",\"fait\":0}"
```

### Modifier un todo

```bash
curl -X PUT http://127.0.0.1:8000/api/todos/1 \
  -H "Content-Type: application/json" \
  -H "X-API-KEY: votre-cle-api" \
  -d "{\"title\":\"Apprendre Laravel API\",\"fait\":1}"
```

### Creer un event

```bash
curl -X POST http://127.0.0.1:8000/api/events \
  -H "Content-Type: application/json" \
  -H "X-API-KEY: votre-cle-api" \
  -d "{\"title\":\"Revision\",\"startHour\":9,\"endHour\":11,\"colorValue\":\"#3b82f6\",\"date_event\":\"2026-05-06\"}"
```

## Champs attendus

### Todo

<table>
    <thead>
        <tr>
            <th align="left">Champ</th>
            <th align="left">Type</th>
            <th align="left">Obligatoire</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>title</code></td>
            <td><code>string</code></td>
            <td>Oui</td>
        </tr>
        <tr>
            <td><code>fait</code></td>
            <td><code>integer</code></td>
            <td>Non</td>
        </tr>
    </tbody>
</table>

### Event

<table>
    <thead>
        <tr>
            <th align="left">Champ</th>
            <th align="left">Type</th>
            <th align="left">Obligatoire</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>title</code></td>
            <td><code>string</code></td>
            <td>Oui</td>
        </tr>
        <tr>
            <td><code>startHour</code></td>
            <td><code>number</code></td>
            <td>Non</td>
        </tr>
        <tr>
            <td><code>endHour</code></td>
            <td><code>number</code></td>
            <td>Non</td>
        </tr>
        <tr>
            <td><code>colorValue</code></td>
            <td><code>string</code></td>
            <td>Non</td>
        </tr>
        <tr>
            <td><code>date_event</code></td>
            <td><code>date</code></td>
            <td>Non</td>
        </tr>
    </tbody>
</table>
