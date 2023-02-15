<?php

namespace Domain\Shop\Models;

use App\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $label
 * @property string $key
 * @property string $value
 */
class Settings extends Model
{
    protected $guarded = [];

    public static function options(): array
    {
        if (! Cache::has('settings.options')) {
            $options = self::all()->pluck('value', 'key')->toArray();

            Cache::forever('settings.options', $options);
        }

        return Cache::get('settings.options');
    }
}
