<?php

namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'Low';
    case MEDIUM = 'Medium';
    case HIGH = 'High';

    case CRITICAL = 'Critical';
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
