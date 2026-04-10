<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Bus;

class ImportUserJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $filePath)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fullPath = storage_path('app/private/' . $this->filePath);

        $file = fopen($fullPath, 'r');

        fgetcsv($file, 1000, ";");

        $chunk = [];
        $chunkSize = 5000;


        while(($row = fgetcsv($file, 1000, ";")) !== FALSE){
            if(!isset($row[1])) continue;

            $chunk[] = $row;

            if(count($chunk) >= $chunkSize){
                ProcessUsersChunkJob::dispatch($chunk);
            }

            // User::updateOrCreate([
            //     'name' => $row[0],
            //     'email' => $row[1],
            //     'password' => $row[2]
            // ]);
        }
        if(!empty($chunk)){
            ProcessUsersChunkJob::dispatch($chunk);
        }

        fclose($file);

    }
}
