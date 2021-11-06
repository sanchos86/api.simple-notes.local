<?php

namespace App\NoteSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Completed implements Filter
{
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('completed', filter_var($value, FILTER_VALIDATE_BOOLEAN));
    }
}
