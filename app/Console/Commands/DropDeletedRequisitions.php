<?php

namespace App\Console\Commands;

use App\Models\Demande;
use App\Models\DemandeDetail;
use App\Models\Traitement;
use Illuminate\Console\Command;

class DropDeletedRequisitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'req:drop-deleted-requisitions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reqs = Traitement::select('demande_id')->distinct()->get();
        foreach ($reqs as $key => $req) {
            $dropped_req = Demande::where('id', $req->demande_id)->exists();
            if ($dropped_req === false) {
                DemandeDetail::where('demande_id', $req->demande_id)->delete();
                Traitement::where('demande_id', $req->demande_id)->delete();
            }
        }
    }
}
