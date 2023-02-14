<?php

/**
 * Format price for humans
 *
 * @param int $price
 *
 * @return string
 */
function price(int $price): string
{
    return number_format($price, 0, '.', ' ');
}

/**
 * Format phone for humans
 *
 * @param string $phone
 *
 * @return string
 */
function phone(string $phone): string
{
    $start = substr($phone, 0, 7);
    $start = str_replace('(', ' (', $start);
    $start = str_replace(')', ') ', $start);

    return $start.substr($phone, 7, 3).'-'.substr($phone, 10, 2).'-'.substr($phone, 12, 2);
}

/**
 * @param string $phone
 *
 * @return string
 */
function clean_phone(string $phone): string
{
    return '8'.str_replace(['+7', '(', ')', ' ', '-'], '', $phone);
}

/**
 * @param string|null $image
 * @return string|null
 */
function image_url(?string $image = null): ?string
{
    return $image ? env('APP_URL').'/'.trim($image, '/') : null;
}
