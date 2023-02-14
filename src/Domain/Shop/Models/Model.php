<?php

namespace Domain\Shop\Models;

use App\Model as AppModel;
use Domain\CMS\Models\Traits\Filterable;

/**
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Model extends AppModel
{
    use Filterable;
}
