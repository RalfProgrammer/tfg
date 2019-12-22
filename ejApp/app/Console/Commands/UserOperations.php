<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserOperations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hv:password_change {pass=1234} {user_id=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user user password based on user id';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->argument('user_id');
        $pass = $this->argument('pass');
        //$this->info('User id ' . $userId . 'Password' . $pass);
        $passEnc = Hash::make($pass);
        //$this->info("password new:" . $passEnc);
        $user = \App\User::find($userId);
        $user->password = $passEnc;
        $res = $user->save();
        if(!$res) {
            $this->warn("No update required for user id {$userId}");
        }
        else {
            $this->info("Updated user id {$userId}");
        }
       
    }
}
