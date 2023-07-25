<?php

namespace App\Features;

class GetColorFromStringFeature
{
    private const COLORS = [
        'FFFFCC',
        'FF9900',
        'FF6633',
        'FFCCCC',
        'FF99CC',
        '9966CC',
        'CCCCFF',
        '6699FF',
        '99CCCC',
        '99FFCC',
        '66FF99',
        'CCFF99',
        // ----
        'CD5C5C',
        'FA8072',
        'FFA07A',
        'FF0000',
        '8B0000',
        // ----
        'FFC0CB',
        'FF69B4',
        'C71585',
        'DB7093',
        // ----
        'FFA07A',
        'FF6347',
        'FF8C00',
        'FFFF00',
        'FFFACD',
        // ----
        'D8BFD8',
        'DA70D6',
        '9370DB',
        '9932CC',
        '6A5ACD',
        // ----
        '32CD32',
        '90EE90',
        '00FF7F',
        '2E8B57',
        '008000',
        // ----
        '00FFFF',
        'E0FFFF',
        '7FFFD4',
        '48D1CC',
        '5F9EA0',
    ];

    public function handle(string $str)
    {
        $hash = abs(crc32($str));
        return self::COLORS[$hash % count(self::COLORS)];
    }
}
