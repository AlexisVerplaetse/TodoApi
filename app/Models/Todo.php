<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Todo
 *
 * @property int $id
 * @property string $title
 * @property int|null $fait
 * @property int|null $id_user
 */
class Todo extends Model
{
    protected $table = 'todos';

    protected $connection = 'pgsql';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'fait',
        'id_user',
    ];

    protected $attributes = [
        'title' => '',
        'fait' => 0,
        'id_user' => null,
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'title' => 'string',
            'fait' => 'integer',
            'id_user' => 'integer',
        ];
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}