<?php
namespace App\Models\Master;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Biodata extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'ref_biodata';
    
    protected $fillable     = [
        'nip',
        'nik',
        'nama',
        'tmp_lahir',
        'tgl_lahir',
        'pendidikan',
        'jurusan',
        'tahun_pendidikan',
        'golongan_id',
        'tmt_golongan',
        'unit_kerja_id',
    ];
    /* End Attributes Model */


    /* Relation */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
