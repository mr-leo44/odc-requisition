<?php

namespace App\Console\Commands;

use App\Models\Demande;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class CountLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:count-level';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'le nombre des approbateurs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = DB::table('traitements')
        ->select('demande_id','status',DB::raw('count(approbateur_id) as approbateurs_count'))
        ->groupBy('demande_id','status')
        ->get();

        foreach($count as $count){
            $this->info("Demande ID: {$count->demande_id} - Nombre d'approbateurs: {$count->approbateurs_count} - Status: {$count->status}");
        }
    }
}
