<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class UnitKerja extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_unit_kerja';
    
    protected $fillable     = [
        'kota_id',
        'npsn',
        'nama',
        'alamat',
        'kecamatan',
    ];
    /* End Attributes Model */


    /* Relation */
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
