<?php
namespace App\Models\Transaction;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Master\Penolakan;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class DupakDetailTolak extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'trans_dupak_detail_tolak';
    
    protected $fillable     = [
        'dupak_detail_id',
        'penolakan_id',
    ];
    /* End Attributes Model */


    /* Relation */
    public function detail()
    {
        return $this->belongsTo(DupakDetail::class, 'dupak_detail_id');
    }

    public function penolakan()
    {
        return $this->belongsTo(Penolakan::class, 'penolakan_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
