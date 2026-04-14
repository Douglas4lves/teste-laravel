<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('users:delete-expired-users')]
#[Description('Command description')]
class DeleteExpiredUsers extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->subMonths(6);

        $users = User::whereNotNull('expires_at')
            ->where('expires_at', '<=', $date)
            ->delete();

        $this->info("Usuários removidos: " . $users);
    }
}
