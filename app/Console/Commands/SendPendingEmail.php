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
        $mails = Mail::where('is_approved','=', false)->get();
        // dd($mails);
        foreach ($mails as $key => $mail) {
            $recent_demande = $mail->demande;
            $user_id = $recent_demande->user_id;
            $user = User::find($user_id);
            $manager_id = (int)($user->compte->manager);
            $manager = User::find($manager_id);
            $recent_demande['manager'] = $manager->name;

            DemandeMailer::to($manager->email, $manager->name)->send(new DemandeMail($recent_demande, true));
        }
    }
}
