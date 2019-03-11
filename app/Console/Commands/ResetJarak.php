<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/* models */
use App\Models\RegistrationModel;

/* libraries */
use App\Libraries\PPDB;

class ResetJarak extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:jarak';

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
        $this->info('lagi ingin reset jarak...');

        $record = RegistrationModel::select('id', 'code', 'coordinate_lat', 'coordinate_lng', 'first_choice', 'second_choice', 'third_choice', 'score_range1', 'score_range2', 'score_range3')
                                     ->whereRaw("substr(code, 6, 1) = 6")
                                     ->get();

        $bar = $this->output->createProgressBar(count($record));
        foreach ($record as $row) {
            if ($row->first_choice) {
                $row->score_range1 = PPDB::getDistance(PPDB::getCoordinteByChoiceId($row->first_choice), $row->koordinat);
            }

            if ($row->second_choice) {
                $row->score_range2 = PPDB::getDistance(PPDB::getCoordinteByChoiceId($row->second_choice), $row->koordinat);
            }

            if ($row->third_choice) {
                $row->score_range3 = PPDB::getDistance(PPDB::getCoordinteByChoiceId($row->third_choice), $row->koordinat);
            }

            $row->save();
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
