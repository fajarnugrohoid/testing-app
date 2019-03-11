<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Authentication\User;
use App\Models\Master\UnitKerja;
use App\Models\Master\Golongan;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class StepConditions extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'step_conditions';
    
    protected $fillable     = [
        'id',
        'test_case_id',
        'step_no',
        'what_to_do',
        'expected_result'
    ];
    /* End Attributes Model */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */

}
