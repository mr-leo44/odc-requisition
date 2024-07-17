<?php

namespace App\Console\Commands;

use App\Models\Mail;
use App\Models\User;
use App\Mail\DemandeMail;
use App\Models\Demande;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail as DemandeMailer;

class SendPendingEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'req:send-pending-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vous avez des demandes de requisition en attente de validation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mails = Mail::where('is_approved', '=', false)->get();
        foreach ($mails as $key => $mail) {
            $traitement_recent = $mail->traitement;
            $demande_recente = $traitement_recent->demande;
            $validateur = User::find($traitement_recent->approbateur_id);
            $demande_recente['validateur'] = $validateur->name;
            $demande_recente['success'] = true;
            DemandeMailer::to($validateur->email, $validateur->name)->send(new DemandeMail($demande_recente, true));
        }
    }
}
