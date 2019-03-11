<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Golongan extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_golongan';
    
    protected $fillable     = [
        'nama',
        'pangkat',
        'jabatan',
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
