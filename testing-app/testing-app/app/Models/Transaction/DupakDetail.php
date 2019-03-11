<?php
namespace App\Models\Transaction;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Master\AngkaKredit;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class DupakDetail extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'trans_dupak_detail';
    
    protected $fillable     = [
        'dupak_id',
        'angka_kredit_id',
        'nilai_angka_kredit',
        'deskripsi',
        'tahun',
        'status',
    ];
    /* End Attributes Model */


    /* Relation */
    public function angkaKredit()
    {
        return $this->belongsTo(AngkaKredit::class, 'angka_kredit_id');
    }

    public function penolakan()
    {
        return $this->hasMany(DupakDetailTolak::class, 'dupak_detail_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
