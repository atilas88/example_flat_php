<?php

declare(strict_types=1);

namespace App\Utils;

class Utils
{
    public static function flattenArray($data, $prefix = ''): array
    {
        $return = [];
        foreach ($data as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $return = array_merge($return, self::flattenArray($value, $prefix . $key . '_'));
            } else {
                $return[$prefix . $key] = $value;
            }
        }
        return $return;
    }

}
