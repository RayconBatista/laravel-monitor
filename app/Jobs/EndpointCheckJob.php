<?php

namespace App\Jobs;

use App\Models\Endpoint;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Null_;

class EndpointCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Endpoint $endpoint
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $url = $this->endpoint->url();
            $response = Http::get($url);
        
            $status_code = $response->status();
            $response_body = $this->responseBody($response);
        
            $this->endpoint->checks()->create([
                'status_code' => $status_code,
                'response_body' => $response_body
            ]);
        
            $this->endpoint->update([
                'next_check' => $this->nextCheck()
            ]);
        } catch (RequestException | ConnectionException $e) {
            // Lidar com a exceção aqui, por exemplo, salvar o status_code e a mensagem de erro
            $status_code = $e->getCode();
            $response_body = $e->getMessage();
        
            if ($e instanceof RequestException && $e->response) {
                $status_code = $e->response->status();
                $response_body = $this->responseBody($e->response);
            }
        
            $this->endpoint->checks()->create([
                'status_code' => $status_code,
                'response_body' => $response_body
            ]);
        
            $this->endpoint->update([
                'next_check' => $this->nextCheck()
            ]);
        }
        // $url = $this->endpoint->url();
        // $response = Http::get($url);

        // $this->endpoint->checks()->create([
        //     'status_code' => $response->status(),
        //     'response_body' => $this->responseBody($response)
        // ]);
        // $this->endpoint->update([
        //     'next_check' => $this->nextCheck()
        // ]);
    }

    private function nextCheck()
    {
        return now()->addMinutes($this->endpoint->frequency);
    }

    private function responseBody(Response $response): string|Null
    {
        if ($response->successful()) {
            return null;
        } else {
            return (string) $response->body();
        }
    }
}
