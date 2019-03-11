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

class ResetNhun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:nhun';

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
        $this->info('lagi ingin reset nilai nhun...');

        // get data yg tidak ada nhun nya
        $code = [];
        
        // nhun
        $record = RegistrationModel::select('id', 'un_type', 'un_year', 'un', 'code')->whereRaw("substr(code, 6, 1) = 6")->get();

        // loop data
        $bar = $this->output->createProgressBar(count($record));
        foreach ($record as $row) {
            // $this->info($row->code);
            // cek data un
            $un = UnJuniorModel::where('un', $row->un)
                                 ->where('un_year', $row->un_year)
                                 ->where('un_type', $row->un_type)
                                 ->first();
            if ($un) {
                // kalkulasi ulang
                $total = $un->score_bahasa + $un->score_english + $un->score_math + $un->score_physics;

                // get data nhunnya pendaftar
                $detail = RegistrationNhunScoresModel::where('registration_id', $row->id)->first();
                if ($detail) {
                    $detail->score_bahasa  = $un->score_bahasa;
                    $detail->score_english = $un->score_english;
                    $detail->score_math    = $un->score_math;
                    $detail->score_physics = $un->score_physics;
                    $detail->score_total1  = $total;
                    $detail->score_total2  = $total;
                    $detail->score_total3  = $row->third_choice ? $total : 0;
                    $detail->save();
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
