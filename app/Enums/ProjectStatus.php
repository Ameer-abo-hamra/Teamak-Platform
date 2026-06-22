<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
    case ONHOLD = 'on-hold';
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
