<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UnissulaApiService
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->baseUrl = config('services.unissula.base_url', env('UNISSULA_BASE_URL'));
        $this->clientId = env('UNISSULA_CLIENT_ID');
        $this->clientSecret = env('UNISSULA_CLIENT_SECRET');
    }

    public function getAccessToken(): ?string
    {
        return Cache::remember('UNISSULA_access_token', now()->addMinutes(55), function () {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' . base64_encode("{$this->clientId}:{$this->clientSecret}"),
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ])->post("{$this->baseUrl}/authorization/token", [
                'grant_type' => 'client_credentials',
                'scope'      => 'authorization,akademik,sdi,unissula1',
            ]);

            if ($response->successful()) {
                return $response['access_token'] ?? null;
            }

            Log::error('Failed to fetch UNISSULA token', ['body' => $response->body()]);
            throw new \Exception('Gagal mendapatkan access token dari UNISSULA');
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
