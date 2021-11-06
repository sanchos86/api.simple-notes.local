<?php

namespace App\NoteSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Category implements Filter
{
    public static function apply(Builder $builder, $value): Builder
    {
        $categories = is_array($value) ? $value : [];
        return $builder->whereIn('category_id', $categories);
    }
}
