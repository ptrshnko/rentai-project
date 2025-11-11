<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class AiClient
{
    private Client $client;
    private string $baseUrl;
    private int $timeout;

    public function __construct()
    {
        $this->baseUrl = config('ai.base_url');
        $this->timeout = config('ai.timeout');
        
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
            'http_errors' => false,
        ]);
    }

    /**
     * Check AI service health.
     *
     * @return array{status: string, error?: string}
     */
    public function health(): array
    {
        try {
            $response = $this->client->get('/health', [
                'timeout' => $this->timeout,
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody()->getContents(), true);

            if ($statusCode === 200 && isset($body['status']) && $body['status'] === 'ok') {
                return ['status' => 'ok'];
            }

            return [
                'status' => 'error',
                'error' => "Unexpected response: HTTP {$statusCode}",
            ];
        } catch (GuzzleException $e) {
            Log::error('AI health check failed', [
                'error' => $e->getMessage(),
                'base_url' => $this->baseUrl,
            ]);

            return [
                'status' => 'error',
                'error' => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            Log::error('AI health check exception', [
                'error' => $e->getMessage(),
            ]);

            return [
                'status' => 'error',
                'error' => $e->getMessage(),
            ];
        }
    }
}

