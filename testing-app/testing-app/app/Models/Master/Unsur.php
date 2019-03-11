<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Unsur extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_unsur';
    
    protected $fillable     = [
        'nama',
        'kategori',
    ];
    /* End Attributes Model */


    /* Relation */
    public function subUnsur()
    {
        return $this->hasMany(SubUnsur::class, 'unsur_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
