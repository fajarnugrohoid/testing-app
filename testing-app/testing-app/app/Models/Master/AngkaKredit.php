<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class AngkaKredit extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_angka_kredit';
    
    protected $fillable     = [
        'kategori_id',
        'kode',
        'nama',
        'nilai',
    ];
    /* End Attributes Model */


    /* Relation */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function penolakanAngkaKredit()
    {
        return $this->belongsToMany(Penolakan::class, 'ref_penolakan_angkakredit', 'angka_kredit_id', 'penolakan_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
