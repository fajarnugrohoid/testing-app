<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Kategori extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_kategori';
    
    protected $fillable     = [
        'sub_unsur_id',
        'nama',
    ];
    /* End Attributes Model */


    /* Relation */
    public function subUnsur()
    {
        return $this->belongsTo(SubUnsur::class, 'sub_unsur_id');
    }

    public function angkaKredit()
    {
        return $this->hasMany(AngkaKredit::class, 'kategori_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
