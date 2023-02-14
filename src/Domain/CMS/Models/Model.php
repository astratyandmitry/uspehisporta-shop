<?php

namespace Domain\CMS\Models;

use App\Model as AppModel;
use Domain\CMS\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static Builder filter()
 */
class Model extends AppModel
{
    use Filterable;

    /**
     * @var array
     */
    protected $guarded = [];
}
