<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\WelcomeMail;
use Mail;

class WelcomeWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:welcome-wish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Welcome wishing mail to new registered Customer';

    /**
     * Execute the console command.
     */
    
     public function handle()
     {
         // Get the current time minus 24 hours
         $targetTime = now()->subHours(24);
         $newCustomers = User::where('role', 'customer')
                             ->where('created_at', '<=', $targetTime)
                             ->get();
     
         foreach ($newCustomers as $customer) {
             Mail::to($customer->email)->send(new WelcomeMail($customer));
         }
     
         $this->info('Welcome emails sent successfully.');
     
     }
     

} 