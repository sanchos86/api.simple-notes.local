<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected static function booted()
    {
        static::addGlobalScope('desc', function (Builder $builder) {
            return $builder->orderBy('id', 'desc');
        });
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
