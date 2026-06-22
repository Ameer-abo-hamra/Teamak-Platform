<?php

namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    case CRITICAL = 'critical';
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
