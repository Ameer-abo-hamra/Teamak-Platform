<?php

namespace App\Enums;

enum AccountStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';

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
