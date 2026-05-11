<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Event
 *
 * @property int $id
 * @property string $title
 * @property float|null $startHour
 * @property float|null $endHour
 * @property string|null $colorValue
 * @property Carbon|null $date_event
 * @property int|null $id_user
 */
class Event extends Model
{
    protected $table = 'events';

    protected $connection = 'pgsql';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'startHour',
        'endHour',
        'colorValue',
        'date_event',
        'id_user',
    ];

    protected $attributes = [
        'title' => '',
        'startHour' => null,
        'endHour' => null,
        'colorValue' => '',
        'date_event' => null,
        'id_user' => null,
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'title' => 'string',
            'startHour' => 'float',
            'endHour' => 'float',
            'colorValue' => 'string',
            'date_event' => 'datetime',
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