<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class User
 *
 * @property int $id
 * @property string $email
 * @property string $mdp
 */
class User extends Model
{
    protected $table = 'user_';

    protected $connection = 'pgsql';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'mdp',
    ];

    protected $attributes = [
        'email' => '',
        'mdp' => '',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'email' => 'string',
            'mdp' => 'hashed',
        ];
    }

    /**
     * Relation avec les todos
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class, 'id_user');
    }

    /**
     * Relation avec les events
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'id_user');
    }
}