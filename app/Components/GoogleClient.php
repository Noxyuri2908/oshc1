<?php

namespace App\Components;

use Google_Client as BaseGoogleClient;
use Illuminate\Support\Facades\Auth;

/**
 * Class GoogleClient
 * @package App\Components
 */
class GoogleClient
{
    /**
     * @var BaseGoogleClient
     */
    protected $client;

    /**
     * GoogleClient constructor.
     * @param BaseGoogleClient $client
     */
    public function __construct(BaseGoogleClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return BaseGoogleClient
     * @throws \Exception
     */
    public function getClient($token)
    {
        if (!file_exists(config('google-api.client_path'))) {
            throw new \Exception(
                'You have not create client for application.'
                    . ' Please create on "console.google.com" and save to your storage "storage/google/credentials.json"!'
            );
        }
        $this->client->setAuthConfig(config('google-api.client_path'));
        $this->client->setAccessType('offline');
        $this->client->setAccessToken($token);
        $this->client->setScopes([
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.readonly',
            'https://www.googleapis.com/auth/calendar.events',
            'https://www.googleapis.com/auth/calendar.events.readonly',
            'https://www.googleapis.com/auth/calendar.settings.readonly',
            'https://www.googleapis.com/auth/calendar.addons.execute'
        ]);
        if ($this->client->isAccessTokenExpired()) {
            $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            session('google_token', $this->client->getAccessToken());
            Auth::user()->update(['google_token'=>json_encode($this->client->getAccessToken())]);
        }
        return $this->client;
    }
}
