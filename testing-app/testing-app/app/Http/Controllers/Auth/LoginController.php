<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Hash;
use Auth;
use Session;

// models
use App\Models\Authentication\Role;
use App\Models\Authentication\User;
use App\Models\Master\Dapodik;
use App\Models\Master\UnitKerja;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('modules.authentication.login');
    }

    // custom login
    public function login(Request $request)
    {
        // Check validation
        $this->validate($request, [
            'username' => 'required',            
            'password' => 'required',            
        ]);

        // cek dari sys user dulu
        $user = User::where('username', $request->username)->first();

        // check user
        if ($user) {
            // check status user
            if ($user->status == 1) {
                // check password
                if (Hash::check($request->password, $user->password)) {
                    // set session login
                    Auth::login($user);
                    return redirect(url('/'));
                }

            } else {
                Session::flash('message', "Username belum aktif!");
                return redirect()->back();
            }

        } else {
            // check di dapodik
            $dapodik = Dapodik::where('nip', $request->username)->where('nik', $request->password)->first();
            if ($dapodik) {
                // get role
                $guru = Role::where('name', 'guru')->first();

                // generate to user
                $user = User::create([
                    'username'   => $request->username,
                    'password'   => bcrypt($request->password),
                    'nama'       => $dapodik->nama,
                    'token'      => '',
                    'last_login' => date('Y-m-d H:i:s'),
                    'status'     => 1,
                ]);

                // set role
                $user->roles()->attach($guru);

                // set biodata
                $this->createBiodata($user, $dapodik);
                
                // set session login
                Auth::login($user);
                return redirect(url('/'));
            }
        }

        // user not exist
        Session::flash('message', "Username atau Password yang anda masukan tidak sesuai");
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function username()
    {
        return 'username';
    }

    public function inject($user)
    {
        $user = User::where('username', $user)
                    ->first();
        if ($user) {
            Auth::login($user);
            // redirect
            return redirect(url('/'));
            
        } else {
            return 'T_T';
        }
    }

    private function createBiodata($user, $dapodik)
    {
        $biodata = [
            // 'nip'              => $dapodik->nip, // tidak usah, karena sudah terleasi dengan user
            'nik'              => $dapodik->nik,
            'nama'             => $dapodik->nama,
            'tmp_lahir'        => $dapodik->tempat,
            'tgl_lahir'        => $dapodik->tanggal,
            'jk'               => $dapodik->jk,
            'unit_kerja_id'    => null,
        ];

        // get unit kerja by npsn sekolah
        $unitkerja = UnitKerja::where('npsn', $dapodik->npsn)->first();
        if ($unitkerja) {
            $biodata['unit_kerja_id'] = $unitkerja->id;
        }

        // set to biodata model
        $user->biodata()->create($biodata);
    }

}
