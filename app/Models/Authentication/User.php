<?php

namespace App\Models\Authentication;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// entrust
use Zizaco\Entrust\Traits\EntrustUserTrait;

// Models
use App\Models\Master\Biodata;
use App\Models\Project\Project;
use App\Models\Project\Task;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    public $table = 'sys_users';
    public $remember_token = false;

    protected $fillable = [
      'username', 'nama', 'cabang_dinas_id',
      'password','jabatan_id','role_id', 'deleted_at', 'last_login'
    ];

    /* Relation */
    public function biodata()
    {
        return $this->hasOne(Biodata::class, 'nip', 'username');
    }

    // public function projects()
    // {
    //     return $this->belongsToMany(Project::class, 'trans_project_member', 'user_id', 'project_id');
    // }

    // public function tasks()
    // {
    //     return $this->belongsToMany(Task::class, 'trans_task_personil', 'user_id', 'task_id');
    // }
    /* End Relation */

    /* Mutator */

    /* End Mutator */

    /* Custom Function */

    /* End Custom Function */
}
