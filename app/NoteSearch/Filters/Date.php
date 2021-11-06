<?php

namespace App\NoteSearch\Filters;

use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class Date implements Filter
{
    public static function apply(Builder $builder, $value): Builder
    {
        try {
            $date = new DateTime($value);
        } catch (Exception $e) {
            $date = null;
        }
        if ($date instanceof DateTime) {
            $startDate = (clone $date)->setTime(0, 0, 0);
            $endDate = (clone $date)->setTime(23, 59, 59);
            return $builder->whereBetween('date', [$startDate, $endDate]);
        }
        return $builder;
    }
}
