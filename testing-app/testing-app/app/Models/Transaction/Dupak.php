<?php
namespace App\Models\Transaction;

// laravel
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Authentication\User;
use App\Models\Master\UnitKerja;
use App\Models\Master\Golongan;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Dupak extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    /* Attributes Model */
    protected $table        = 'trans_dupak';
    
    protected $fillable     = [
        'user_id',
        'tanggal',
        'pendidikan',
        'jurusan',
        'tahun_lulus',
        'golongan_sekarang_id',
        'golongan_target_id',
        'tmt_golongan',
        'unit_kerja_id',
        'total_akhir',
        'status',
        'cabdin_at',
        'sekretariat_at',
        'penilai_at',
    ];
    /* End Attributes Model */


    /* Relation */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penilai()
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function detail()
    {
        return $this->hasMany(DupakDetail::class, 'dupak_id');
    }

    public function golonganSekarang()
    {
        return $this->belongsTo(Golongan::class, 'golongan_sekarang_id');
    }

    public function golonganUsulan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_target_id');
    }
    /* End Relation */


    /* Mutator */

    /* End Mutator */


    /* Scope */

    /* End Scope */


    /* Custom Function */

    /* End Custom Function */
}
