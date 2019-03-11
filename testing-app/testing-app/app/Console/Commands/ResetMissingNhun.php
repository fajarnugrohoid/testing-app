<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/* models */
use App\Models\RegistrationModel;
use App\Models\UnJuniorModel;
use App\Models\RegistrationNhunScoresModel;

/* libraries */
use App\Libraries\PPDB;
use App\Libraries\NonAcademic;

class ResetMissingNhun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:missingnhun_x';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('lagi ingin reset missing nhun...');

        // get data yg tidak ada nhun nya
        $code = [];
        
        // ketm
        $miss_nhun = RegistrationModel::queryRaw("
            select r.id
            from ppdb_registrations r
            where 
            substr(r.code, 6, 1) = 1
            and r.id not in (select registration_id from ppdb_registration_nhun_scores)
        ");

        foreach ($miss_nhun as $row) {
            $code[] = $row->id;
        }

        // pmg
        $miss_nhun = RegistrationModel::queryRaw("
            select r.id
            from ppdb_registrations r
            where 
            substr(r.code, 6, 1) = 2
            and r.id not in (select registration_id from ppdb_registration_nhun_scores)
        ");

        foreach ($miss_nhun as $row) {
            $code[] = $row->id;
        }

        // wps
        $miss_nhun = RegistrationModel::queryRaw("
            select r.id
            from ppdb_registrations r
            where 
            substr(r.code, 6, 1) = 4
            and r.id not in (select registration_id from ppdb_registration_nhun_scores)
        ");

        foreach ($miss_nhun as $row) {
            $code[] = $row->id;
        }

        // prestasi
        $miss_nhun = RegistrationModel::queryRaw("
            select r.id
            from ppdb_registrations r
            where 
            substr(r.code, 6, 1) = 5
            and r.id not in (select registration_id from ppdb_registration_nhun_scores)
        ");

        foreach ($miss_nhun as $row) {
            $code[] = $row->id;
        }

        // get record
        $record = RegistrationModel::with('nhunScores')
                    ->select('id', 'code', 'un', 'un_year', 'un_type', 'first_choice', 'second_choice', 'third_choice', 'status')
                    ->whereIn('id', $code)
                    ->get();

        $bar = $this->output->createProgressBar(count($record));
        foreach ($record as $row) {
            if (!isset($row->nhunScores->id)) {
                // cek ke table un junior
                $nhun = $record = UnJuniorModel::where('un', $row->un)->where('un_year', $row->un_year)->where('un_type', $row->un_type)->first();

                if ($nhun) { // jika ada inject
                    $inj = new RegistrationNhunScoresModel();
                    $inj->registration_id = $row->id;
                    $inj->score_bahasa    = $nhun->score_bahasa;
                    $inj->score_english   = $nhun->score_english;
                    $inj->score_math      = $nhun->score_math;
                    $inj->score_physics   = $nhun->score_physics;

                    if ($row->first_choice) {
                        $inj->score_total1 = $nhun->score_bahasa + $nhun->score_english + $nhun->score_math + $nhun->score_physics;
                    }

                    if ($row->second_choice) {
                        $inj->score_total2 = $nhun->score_bahasa + $nhun->score_english + $nhun->score_math + $nhun->score_physics;
                    }

                    if ($row->third_choice) {
                        $inj->score_total3 = $nhun->score_bahasa + $nhun->score_english + $nhun->score_math + $nhun->score_physics;
                    }

                    $inj->save();
                } else { // jika tidak ubah status jadi new lagi, sina operator input deui
                    $row->status = 'new';
                    $row->save();
                }
            }

            $bar->advance();
        }

        $bar->finish();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    
}
