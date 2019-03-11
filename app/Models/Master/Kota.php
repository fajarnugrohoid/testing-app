<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Kota extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_kota';
    
    protected $fillable     = [
        'cadisdik_id',
        'nama',
    ];
    /* End Attributes Model */


    /* Relation */
    public function cadisdik()
    {
        return $this->belongsTo(Cadisdik::class, 'cadisdik_id');
    }

    public function unitKerja()
    {
        return $this->hasMany(UnitKerja::class, 'kota_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
