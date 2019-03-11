<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Penolakan extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_penolakan';
    
    protected $fillable     = [
        'nomor',
        'sub_nomor',
        'judul',
        'alasan',
        'saran',
    ];
    /* End Attributes Model */


    /* Relation */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function penolakanAngkaKredit()
    {
        return $this->belongsToMany(AngkaKredit::class, 'ref_penolakan_angkakredit', 'penolakan_id', 'angka_kredit_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
