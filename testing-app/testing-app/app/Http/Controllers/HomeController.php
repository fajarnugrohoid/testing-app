<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* models */

/* libraries*/

/* trait */

class HomeController extends Controller
{
    protected $link = '/';
    
    function __construct()
    {
        $this->setTitle("Home");

        // set link
        $this->setLink($this->link);
    }

    public function index()
    {
        // if (\Auth::user()->hasRole('guru')) {
        //     $guru   = new GuruController;
        //     return $guru->dashboard();
        // }elseif (\Auth::user()->hasRole('penilai')) {
        //     return $this->render('modules.penilai.dashboard');
        // }elseif (\Auth::user()->hasRole('sekretariat')) {
        //     $sekre  = new SekretariatController;
        //     return $sekre->dashboard();
        //     // return $this->render('modules.sekretariat.dashboard');
        // }if (\Auth::user()->hasRole('tester')) {
        //     $tester   = new TesterController;
        //     return $tester->dashboard();
        // }

        return $this->render('modules.home');
    }

}