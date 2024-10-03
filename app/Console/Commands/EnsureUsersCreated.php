<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Compte;
use App\Mail\UserMail;
use App\Models\Approbateur;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class EnsureUsersCreated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'req:ensure-users-created';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vous avez été Ajouté dans Requisition App';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $managers = Compte::select('manager')->distinct()->get();
        $approvers = Approbateur::where('deleted_at', null)->get();
        $response = Http::get("http://10.143.41.70:8000/promo2/odcapi/?method=getUsers");
        if ($response->successful()) {
            $users = $response->json()['users'];
        }

        foreach ($managers as $managerData) {
            $manager_id = $managerData->manager;
            foreach ($users as $user) {
                if ($user['id'] === $manager_id) {
                    $manager_name = $user['first_name'] . ' ' . $user['last_name'];
                    if (User::where('name', $manager_name)->first() === null) {
                        $user['name'] = $manager_name;
                        $user['manager'] = true;
                        Mail::to($user['email'], $manager_name)->send(new UserMail($user));
                    }
                }
            }
        }

        foreach ($approvers as $approver) {
            foreach ($users as $user) {
                if ($user['email'] === $approver->email) {
                    $validator_name = $user['first_name'] . ' ' . $user['last_name'];
                    if (User::where('name', $validator_name)->first() === null) {
                        $user['approver'] = true;
                        $user['name'] = $validator_name;
                        Mail::to($user['email'], $validator_name)->send(new UserMail($user));
                    }
                }
            }
        }
    }
}
