<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google_Client;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    //

    public function redirectToGoogleAuth()
    {
//        $credentialsPath = config('google-api.token_path');
//        if (file_exists($credentialsPath)) {
//            $accessToken = json_decode(file_get_contents($credentialsPath), true);
//        }
        $getUserToken = Auth::user()->google_token;
        $accessToken = json_decode($getUserToken, true);

        if (!empty($accessToken)) {
            \Session::put('google_token', $accessToken);
        }
        if (\Session::has('google_token')) {
            return redirect()->route('event.index');
        }
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setScopes([
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.readonly',
            'https://www.googleapis.com/auth/calendar.events',
            'https://www.googleapis.com/auth/calendar.events.readonly',
            'https://www.googleapis.com/auth/calendar.settings.readonly',
            'https://www.googleapis.com/auth/calendar.addons.execute'
        ]);

        $client->setRedirectUri(route('login.google.callback'));
        $client->setAccessType('offline');        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->setApprovalPrompt('force');
        $auth_url = $client->createAuthUrl();
        header('Location: ' . $auth_url);
        die();
    }
    public function loginGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setScopes([
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.readonly',
            'https://www.googleapis.com/auth/calendar.events',
            'https://www.googleapis.com/auth/calendar.events.readonly',
            'https://www.googleapis.com/auth/calendar.settings.readonly',
            'https://www.googleapis.com/auth/calendar.addons.execute'
        ]);
        $client->setRedirectUri(route('login.google.callback'));
        $client->setAccessType('offline');        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->setApprovalPrompt('force');
        if ($request->get('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
            \Session::put('google_token', $token);
            Auth::user()->update(['google_token'=>json_encode($token)]);
            // session('google_token', $token['access_token']);
            return redirect()->route('event.index');
        } else {
            return redirect()->route('login.google');
        }
    }
    public function logoutGoogle(Request $request)
    {
        \Session::forget('google_token');
        Auth::user()->update(['google_token'=>null]);
        return route('login.google');
    }
}
