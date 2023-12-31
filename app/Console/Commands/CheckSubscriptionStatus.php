<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Console\Command;
use App\Notifications\SubscribeTime;
use Illuminate\Support\Facades\Notification;

class CheckSubscriptionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:subscription-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if any user subscription is about to end and notify admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('role', 'subscriber')->whereNotNull('subscribe_time')->get();

        foreach($users as $user)
        {
            // Parse subscribe_time as a date string and get the start of the day (00:00:00)
            $subscriptionEnd = Carbon::parse($user->subscribe_time)->startOfDay()->toDateString();
            $now = Carbon::now(new DateTimeZone('Asia/Kuwait'))->startOfDay()->toDateString();

            if($subscriptionEnd === $now)
            {
                $user->status = 'inactive';
                $user->save();

                $admin_user = User::where('role','admin')->get();
                Notification::send($admin_user, new SubscribeTime($user->name));
            }

        }
    }
}



