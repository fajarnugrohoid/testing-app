<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Authentication\User;
use App\Models\Master\UnitKerja;
use App\Models\Master\Golongan;
use App\Models\Testcases;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Projects extends Model
{
    //
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'projects';
    
    protected $fillable     = [
        'id',
        'project_name',
        'description',
        'start_project',
        'end_project',
        'user_id'
    ];
    /* End Attributes Model */

    /* Relation */
    public function getProjects()
    {
        return $this->hasMany(Testcases::class, 'project_id');
    }


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
