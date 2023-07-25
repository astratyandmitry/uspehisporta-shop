<?php

function price(int $price): string
{
    return number_format($price, 0, '.', ' ');
}

function phone(string $phone): string
{
    $start = substr($phone, 0, 7);
    $start = str_replace('(', ' (', $start);
    $start = str_replace(')', ') ', $start);

    return $start.substr($phone, 7, 3).'-'.substr($phone, 10, 2).'-'.substr($phone, 12, 2);
}

function clean_phone(string $phone): string
{
    return '8'.str_replace(['+7', '(', ')', ' ', '-'], '', $phone);
}

function image_url(?string $image = null): ?string
{
    return $image;
}

function checkArraySimilarity($array1, $array2) {
    // Convert arrays to sets to efficiently check for common elements
    $set1 = array_flip($array1);
    $set2 = array_flip($array2);

    // Check for common elements
    foreach ($set1 as $element => $_) {
        if (isset($set2[$element])) {
            return true;
        }
    }

    return false;
}
