<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AgoraService
{
    private $appId;
    private $appCertificate;
    private $customerId;
    private $customerSecret;
    private $baseUrl;
    private $authToken;

    public function __construct()
    {
        $this->appId = config('agora.app_id');
        $this->appCertificate = config('agora.app_certificate');
        $this->customerId = config('agora.customer_id');
        $this->customerSecret = config('agora.customer_secret');
        $this->baseUrl = config('agora.chat_api_base_url');
        $this->authToken = $this->generateAuthToken();
    }

    /**
     * Generate Agora REST API authentication token
     */
    private function generateAuthToken(): string
    {
        $plainCredentials = $this->customerId . ':' . $this->customerSecret;
        return base64_encode($plainCredentials);
    }

    /**
     * Generate RTM token for user
     */
    public function generateRTMToken($userId, $expireTime = null): string
    {
        if ($expireTime === null) {
            $expireTime = Carbon::now()->addSeconds(config('agora.rtm.token_expiry'))->timestamp;
        }

        // RTM token generation logic
        // This is a simplified version - you may need to use Agora's PHP SDK for proper token generation
        // For production, consider using: https://github.com/AgoraIO/Tools/tree/master/DynamicKey/AgoraDynamicKey/php
        
        $appId = $this->appId;
        $appCertificate = $this->appCertificate;
        
        // Simplified token - in production use Agora's official token generator
        $token = [
            'app_id' => $appId,
            'user_id' => (string)$userId,
            'expire' => $expireTime,
            'salt' => random_int(1, 99999999),
        ];
        
        // Note: This is a placeholder. For production, use Agora's official token generation library
        // You can use: composer require agora/token-builder
        return base64_encode(json_encode($token));
    }

    /**
     * Generate Chat token for user
     */
    public function generateChatToken($userId): array
    {
        $orgName = config('agora.chat.org_name');
        $appName = config('agora.chat.app_name');
        
        $url = "{$this->baseUrl}/project/{$this->appId}/users/{$userId}/rtmToken";
        
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $this->authToken,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'expire' => config('agora.chat.token_expiry'),
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('Agora Chat Token Generation Failed', [
            'user_id' => $userId,
            'response' => $response->body(),
        ]);

        throw new \Exception('Failed to generate Agora chat token');
    }

    /**
     * Create or get Agora chat user
     */
    public function createUser($userId, $username, $avatar = null): array
    {
        $url = "{$this->baseUrl}/project/{$this->appId}/users/{$userId}";
        
        $payload = [
            'username' => $username,
        ];
        
        if ($avatar) {
            $payload['avatarurl'] = $avatar;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $this->authToken,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        if ($response->successful() || $response->status() === 200) {
            return $response->json();
        }

        // If user already exists, return existing user
        if ($response->status() === 400) {
            return $this->getUser($userId);
        }

        Log::error('Agora User Creation Failed', [
            'user_id' => $userId,
            'response' => $response->body(),
        ]);

        throw new \Exception('Failed to create Agora user');
    }

    /**
     * Get Agora chat user
     */
    public function getUser($userId): array
    {
        $url = "{$this->baseUrl}/project/{$this->appId}/users/{$userId}";
        
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $this->authToken,
            'Content-Type' => 'application/json',
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to get Agora user');
    }

    /**
     * Send message via Agora (for server-side message sending)
     */
    public function sendMessage($fromUserId, $toUserId, $message, $messageType = 'txt'): array
    {
        $url = "{$this->baseUrl}/project/{$this->appId}/users/{$fromUserId}/peer_messages";
        
        $payload = [
            'destination' => $toUserId,
            'enable_offline_messaging' => true,
            'payload' => $message,
            'payload_type' => $messageType,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $this->authToken,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('Agora Send Message Failed', [
            'from' => $fromUserId,
            'to' => $toUserId,
            'response' => $response->body(),
        ]);

        throw new \Exception('Failed to send message via Agora');
    }
}

