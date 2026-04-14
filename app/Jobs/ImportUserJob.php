<?php

namespace App\Jobs;

use App\Mail\ImportFinishedMail;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class ImportUserJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $filePath, public $email)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Resolve o caminho absoluto do arquivo
        $fullPath = storage_path('app/private/' . $this->filePath);

        $file = fopen($fullPath, 'r');

        // Remove o cabeçalho do CSV
        fgetcsv($file, 1000, ",");

        // armazenamento temporário para agrupar registros antes de enviar para jobs
        $chunk = [];
        $chunkSize = 500;

        $jobs = [];

        // Percorre o arquivo linha por linha
        while(($row = fgetcsv($file, 1000, ",")) !== FALSE){
            //existe email para validar?
            if(!isset($row[1])) continue;

            $chunk[] = $row;

            //cria um job quando atingir o limite permitido
            if(count($chunk) >= $chunkSize){
                $jobs[] =new ProcessUsersChunkJob($chunk);
                $chunk = [];
            }

        }
        // Processa o último lote restante que não completou o chunk size
        if(!empty($chunk)){
            $jobs[] = new ProcessUsersChunkJob($chunk);
        }

        fclose($file);

        //Executa em batch para processamento paralelo e quando concluido envia o email
        Bus::batch($jobs)
            ->then(new SendImportFinishedEmailJob($this->email))
            ->catch(function (Batch $batch, Throwable $e) {
                Log::error('Erro no batch: ' . $e->getMessage());
            })
            ->dispatch();//dispara o batch para executar a fila
        
    }
}
