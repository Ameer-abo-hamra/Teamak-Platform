<?php

namespace App\Enums;
enum TaskStatus: string
{
    case TODO = 'to-do';
    case INPROGRESS = 'in-progress';
    case INREVIEW = 'in-review';

    case DONE = 'done';
    public static function labels(): array
    {
        return array_column(
            array_map(fn($case) => [
                'value' => $case->value,
                'label' => ucfirst($case->value),
            ], self::cases()),
            'label',
            'value'
        );
    }


}
