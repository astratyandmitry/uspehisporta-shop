<?php

namespace Domain\Shop\Models\Interfaces;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
interface HasUrl
{
    /**
     * @return string
     */
    public function url(): string;
}
