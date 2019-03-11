<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class SubUnsur extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_sub_unsur';
    
    protected $fillable     = [
        'unsur_id',
        'nama',
    ];
    /* End Attributes Model */


    /* Relation */
    public function unsur()
    {
        return $this->belongsTo(Unsur::class, 'unsur_id');
    }

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'sub_unsur_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
