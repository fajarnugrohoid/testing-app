<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/* models */
use App\Models\RegistrationModel;

/* libraries */
use App\Libraries\PPDB;
use App\Libraries\NonAcademic;

class ResetPrestasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:prestasi_x';

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
        $this->info('lagi ingin reset prestasi...');

        $record = RegistrationModel::with('prestasiScores')->where(\DB::raw("SUBSTR(code, 6, 1)"), '5')->get();

        $bar = $this->output->createProgressBar(count($record));
        foreach ($record as $row) {
            if ($row->prestasiScores) {
                $request = [
                    'organizer' => $row->prestasiScores->organizer,
                    'level'     => $row->prestasiScores->level,
                    'ranking'   => $row->prestasiScores->ranking,
                    'type'      => $row->prestasiScores->type,
                ];
                
                //dump($request, NonAcademic::getSkorPrestasi($request));
                $row->prestasiScores->score = NonAcademic::getSkorPrestasi($request);
                $row->prestasiScores->save();
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
