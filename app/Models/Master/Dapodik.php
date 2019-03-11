<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Dapodik extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_dapodik';
    
    protected $fillable     = [
        'nip',
        'nik',
        'nama',
        'jk',
        'tempat',
        'tanggal',
        'npsn',
        'sekolah',
        'alamat',
        'kec',
        'daerah',
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
