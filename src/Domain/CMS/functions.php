<?php

/**
 * @param bool $boolean
 * @param bool $asParameter
 * @return string
 */
function isActive(bool $boolean, bool $asParameter = true): void
{
    if ($boolean) {
        echo ($asParameter) ? 'class="is-active"' : ' is-active';
    }

    echo '';
}

/**
 * Return array of  not empty $_GET parameters
 *
 * @return array
 */
function getNotEmptyQueryParameters(): array
{
    $parameters = [];

    if (count($_GET)) {
        foreach ($_GET as $key => $value) {
            if ($value !== "") {
                $parameters[$key] = $value;
            }
        }
    }

    return $parameters;
}

/**
 * @param string $str
 * @param int $limit
 * @return string|null
 */
function shorten(?string $str, int $limit = 50): ?string
{
    if (is_null($str)) {
        return null;
    }

    if (mb_strlen($str) > $limit) {
        return mb_substr($str, 0, $limit).'...';
    }

    return $str;
}

/**
 * @param int $id
 * @return string
 */
function hid(int $id): string
{
    return str_pad($id, 7, '0', STR_PAD_LEFT);
}

/**
 * @param string $class
 * @param bool $boolean
 * @return string
 */
function apply_class_when(string $class, bool $boolean): string
{
    return $boolean ? $class : '';
}
