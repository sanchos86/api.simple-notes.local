<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Database\Eloquent\Relations\{BelongsTo};

class Note extends Model
{
    const NORMAL = 'normal';
    const MAJOR = 'major';
    const CRITICAL = 'critical';

    use HasFactory;

    protected $fillable = [
        'priority',
        'description',
        'date',
        'completed',
        'category_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope('desc', function (Builder $builder) {
            return $builder->orderBy('id', 'desc');
        });
    }

    public static function getPrioritiesOptions(): array
    {
        return [
            self::NORMAL,
            self::MAJOR,
            self::CRITICAL
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
