<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessUsersChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $rows)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [];

        foreach ($this->rows as $row) {

            if(!isset($row[1])) continue;

            $email = strtolower(trim($row[1]));

            $data[] = [
                'name' => $row[0],
                'email' => $row[1],
                'password' => bcrypt($row[2]),
                'is_admin' => str_ends_with($email,'@fontecred.com.br')
            ];
        }

        User::upsert(
            $data,
            ['email'],
            ['name','password']
        );
    }
}
