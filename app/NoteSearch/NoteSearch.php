<?php

namespace App\NoteSearch;

use App\Models\Note;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NoteSearch
{
    public static function apply(Request $filters): Builder
    {
        $query = Note::query();
        return static::applyFiltersFromRequest($filters, $query);
    }

    public static function applyFiltersFromRequest(Request $filters, Builder $query): Builder
    {
        foreach ($filters->query() as $filterName => $filterValue) {
            $class = static::createFilterClass($filterName);

            if (static::isClassExists($class)) {
                $query = $class::apply($query, $filterValue);
            }
        }
        return $query;
    }

    public static function createFilterClass(string $filterName): string
    {
        return __NAMESPACE__ . '\\Filters\\' . Str::studly($filterName);
    }

    public static function isClassExists($class): bool
    {
        return class_exists($class);
    }
}
