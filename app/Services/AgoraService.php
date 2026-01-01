<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AgoraService
{
    protected $appId;
    protected $appCertificate;
    protected $baseUrl;

    public function __construct()
    {
        $this->appId = config('agora.app_id');
        $this->appCertificate = config('agora.app_certificate');
        $this->baseUrl = config('agora.base_url', 'https://api.agora.io');
    }

    /**
     * Create or get Agora Chat user
     */
    public function createUser($userId, $username, $avatarUrl = null)
    {
        try {
            $response = Http::withBasicAuth($this->appId, $this->appCertificate)
                ->post("{$this->baseUrl}/dev/v2/users/{$userId}", [
                    'username' => $username,
                    'nickname' => $username,
                    'avatarurl' => $avatarUrl,
                ]);

            if ($response->successful()) {
                Log::info('Agora user created/updated', ['user_id' => $userId]);
                return $response->json();
            } else {
                // User might already exist, which is fine
                if ($response->status() === 400) {
                    Log::info('Agora user already exists', ['user_id' => $userId]);
                    return ['success' => true];
                }
                Log::warning('Failed to create Agora user', [
                    'user_id' => $userId,
                    'response' => $response->body()
                ]);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Agora user creation error', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Generate Agora Chat token
     */
    public function generateChatToken($userId, $expiresIn = 86400)
    {
        try {
            $response = Http::withBasicAuth($this->appId, $this->appCertificate)
                ->post("{$this->baseUrl}/dev/v2/token/users/{$userId}", [
                    'expire' => $expiresIn,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('Agora token generated', ['user_id' => $userId]);
                return [
                    'token' => $data['accessToken'] ?? $data['token'] ?? null,
                    'expires_in' => $expiresIn,
                ];
            } else {
                Log::error('Failed to generate Agora token', [
                    'user_id' => $userId,
                    'response' => $response->body()
                ]);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Agora token generation error', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}

