<?php

namespace App\Jobs;

use App\Mail\ImportFinishedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendImportFinishedEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $email)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }


    public function __invoke()
    {
        Mail::to($this->email)
            ->send(new ImportFinishedMail());

        Log::info('Email enviado');
    }
}
