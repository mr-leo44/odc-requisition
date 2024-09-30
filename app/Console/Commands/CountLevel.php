<?php

namespace App\Console\Commands;

use App\Models\Approbateur;
use App\Models\Demande;
use App\Models\Mail;
use App\Models\User;
use App\Models\Traitement;
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
    protected $signature = 'req:count-level';

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
            $demandes = Demande::all();
            foreach($demandes as $demande){
                $last = Traitement::where('demande_id',$demande->id)->orderBy('created_at','desc')->first();
                if($last->status == 'en_cours'){
                    $level = $last->level;
                    if(Approbateur::where('level',$level)->where('deleted_at',null)->exists()){
                        $approbateurs = Approbateur::where('level',$level)->where('deleted_at',null)->first();
                        $approbater_users = User::where('email',$approbateurs->email)->first();
                        if ($last->approbateur_id != $approbater_users->id) {
                            $last->update(['approbateur_id'=>$approbater_users->id]);
                        }
                    }else{
                        Mail::where('traitement_id',$last->id)->delete();
                        $last->delete();
                    }
                }
            }
        }
}
