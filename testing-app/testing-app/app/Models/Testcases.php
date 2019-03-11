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

class Testcases extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'test_cases';
    
    protected $fillable     = [
        'id',
        'project_id',
        'title',
        'severity',
        'version',
        'type_test',
        'description',
        'pre_condition',
        'execution_status'
    ];
    /* End Attributes Model */

    /* Relation */
    public function step_condition()
    {
        return $this->hasMany(StepConditions::class, 'test_case_id');
    }
    /* End Relation */

    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
