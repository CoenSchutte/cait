<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $token = $request->input('token');
        $message = $request->input('message');
        $title = $request->input('title');

        $client = new Client();

        $response = $client->post('https://exp.host/--/api/v2/push/send', [
            'json' => [
                'to' => $token,
                'sound' => 'default',
                'title' => $title,
                'body' => $message,
            ],
        ]);

        return response()->json([
            'success' => true,
            'response' => json_decode($response->getBody()->getContents(), true),
        ]);
    }
}
