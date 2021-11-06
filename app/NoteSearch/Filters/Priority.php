<?php

namespace App\NoteSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Priority implements Filter
{
    /**
     * @param Builder $builder
     * @param array $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        $priorities = is_array($value) ? $value : [];
        return $builder->whereIn('priority', $priorities);
    }
}
