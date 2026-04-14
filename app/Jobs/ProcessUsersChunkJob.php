<?php

namespace App\Jobs;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

// use App\Models\User;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Queue\Queueable;

class ProcessUsersChunkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

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
        //verificar se foi cancelado
        if ($this->batch()?->cancelled()) {
            return;
        }
        //armazena para isenção em massa
        $data = [];

        foreach ($this->rows as $row) {

            //email existe?
            if(!isset($row[1])){
                continue;
            } 

            $email = strtolower(trim($row[1]));

            $data[] = [
                'name' => $row[0],
                'email' => $row[1],
                'password' => Hash::make($row[2]),
                'expires_at' => $row[3],
                'is_admin' => str_ends_with($email,'@fontecred.com.br')
            ];
        }
        // Caso não exista nenhum registro válido após o processamento, encerra o job
        if(empty($data)){
            return;
        }
        //criar ou atualizar o registro com base no email
        User::upsert(
            $data,
            ['email'],
            ['name','password']
        );
    }
}
