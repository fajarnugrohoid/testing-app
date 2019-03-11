<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class TypeTest extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_type_tests';
    
    protected $fillable     = [
        'id',
        'name',
    ];
    /* End Attributes Model */


    /* Relation */
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
