<?php

namespace App\Enums;
enum TaskStatus: string
{
    case TODO = 'To-do';
    case INPROGRESS = 'In-progress';
    case INREVIEW = 'In-review';

    case DONE = 'Done';
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
