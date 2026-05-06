<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 *
 * @property int $id
 * @property string $title
 * @property float|null $startHour
 * @property float|null $endHour
 * @property string|null $colorValue
 * @property Carbon|null $date_event
 */
class Event extends Model
{
    protected $table = 'events';

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
        'startHour',
        'endHour',
        'colorValue',
        'date_event',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
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
        ];
    }
}
