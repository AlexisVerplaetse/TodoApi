<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Todo
 *
 * @property int $id
 * @property string $title
 * @property int|null $fait
 */
class Todo extends Model
{
    protected $table = 'todos';

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'fait',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'title' => '',
        'fait' => '0',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'title' => 'string',
            'fait' => 'integer',
        ];
    }
}
