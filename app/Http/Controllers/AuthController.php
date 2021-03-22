<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class AuthController extends Controller
{
    public $status = 200;

    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(env('PASSPORT_LOGIN_ENDPOINT'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('PASSPORT_CLIENT_ID'),
                    'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                    'username' => $request->username,
                    'password' => $request->password,
                ],
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
            $response = json_decode((string)$response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() == '400') {
                    $response = json_encode(('Credentials are wrong.'), true);
                }
            }
        } catch (\Exception $e) {
            $response = json_encode("Please try again later.", true);
        }
        return response()->json($response, 200);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Logged out successfully', 200);
    }
}
