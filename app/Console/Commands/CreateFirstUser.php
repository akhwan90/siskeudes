<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateFirstUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-first-user';

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
        //
        $insert = User::create([
            'name'=>'Administrator',
            'email'=>'admin@localhost.com',
            'password'=>password_hash('admin123', PASSWORD_DEFAULT),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

        echo "User dibuat dengan nama email : admin@localhost.com, password : admin123\n";
    }
}
