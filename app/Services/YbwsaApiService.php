<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class YbwsaApiService
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->baseUrl = config('services.ybwsa.base_url', env('YBWSA_BASE_URL'));
        $this->clientId = env('YBWSA_CLIENT_ID');
        $this->clientSecret = env('YBWSA_CLIENT_SECRET');
    }

    public function getAccessToken(): ?string
    {
        return Cache::remember('ybwsa_access_token', now()->addMinutes(55), function () {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' . base64_encode("{$this->clientId}:{$this->clientSecret}"),
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ])->post("{$this->baseUrl}/authorization/token", [
                'grant_type' => 'client_credentials',
            ]);

            if ($response->successful()) {
                return $response['access_token'] ?? null;
            }

            Log::error('Failed to fetch YBWSA token', ['body' => $response->body()]);
            throw new \Exception('Gagal mendapatkan access token dari YBWSA');
        });
    }

    public function sendRequest(string $endpoint, array $params = [], string $method = 'GET'): array
    {
        $accessToken = $this->getAccessToken();

        $client = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'User-Agent'    => request()->userAgent() ?? 'Laravel',
        ]);

        $url = "{$this->baseUrl}/{$endpoint}";

        $response = match (strtoupper($method)) {
            'GET' => $client->get($url, $params),
            'POST' => $client->post($url, $params),
            'PUT' => $client->put($url, $params),
            'DELETE' => $client->delete($url, $params),
            default => throw new \Exception('HTTP Method tidak didukung')
        };

        if ($response->successful()) {
            return $response->json();
        }

        Log::error("API Error ({$endpoint})", ['status' => $response->status(), 'body' => $response->body()]);
        throw new \Exception('Error dari API: ' . $response->body());
    }
}
