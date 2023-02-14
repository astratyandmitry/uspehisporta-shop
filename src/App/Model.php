<?php

namespace App;

use Domain\CMS\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static Builder filter()
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use Filterable;

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        $class = get_called_class();

        return (new $class)->getTable();
    }

    /**
     * @param array $value
     *
     * @return string
     */
    protected function asJson($value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
