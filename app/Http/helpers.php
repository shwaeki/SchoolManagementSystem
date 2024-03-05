<?php


use App\Models\Message;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Http;

if (!function_exists('sendSms')) {
    function sendSms($message, $phone_number)
    {
        $getToken = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJmaXJzdF9rZXkiOiI2MTMzNyIsInNlY29uZF9rZXkiOiIzNDk5NTM1IiwiaXNzdWVkQXQiOiIxMC0wMS0yMDI0IDEyOjM3OjM0IiwidHRsIjo2MzA3MjAwMH0.8Y1xEd7uP0C6rYJieX--stlpQ5l-VsEmUv_kCxfQLNs";

        if ($getToken) {
            $url = "https://019sms.co.il/api";

            try {

                Message::create([
                    'message' => $message,
                    'phone' => $phone_number,
                    'added_by' => auth()->id(),
                ]);

                $response = Http::withToken($getToken)->post($url, [
                    'sms' => [
                        'user' => ['username' => env('SMS_019_USERNAME')],
                        'source' => env('SMS_019_PHONE'),
                        'destinations' => [
                            'phone' => [
                                '_' => $phone_number,
                            ],
                        ],
                        'message' => $message,
                    ],
                ]);

                $result = $response->json();

                if ($result['status'] == 0) {
                    return true;
                } else {
                    return "Error: " . $result['message'];
                }
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }


    }
}


if (!function_exists('sendSmsBulk')) {
    function sendSmsBulk($message, $phone_numbers)
    {
        $getToken = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJmaXJzdF9rZXkiOiI2MTMzNyIsInNlY29uZF9rZXkiOiIzNDk5NTM1IiwiaXNzdWVkQXQiOiIxMC0wMS0yMDI0IDEyOjM3OjM0IiwidHRsIjo2MzA3MjAwMH0.8Y1xEd7uP0C6rYJieX--stlpQ5l-VsEmUv_kCxfQLNs";


        $phones = [];

        foreach ($phone_numbers as $number) {
            $phones[] = ['_' => $number];

            Message::create([
                'message' => $message,
                'phone' => $number,
                'added_by' => auth()->id(),
            ]);
        }


        if ($getToken) {
            $url = "https://019sms.co.il/api";

            try {
                $response = Http::withToken($getToken)->post($url, [
                    'sms' => [
                        'user' => ['username' => env('SMS_019_USERNAME')],
                        'source' => env('SMS_019_PHONE'),
                        'destinations' => [
                            'phone' => $phones,
                        ],
                        'message' => $message,
                    ],
                ]);


                $result = $response->json();

                if ($result['status'] == 0) {
                    return true;
                } else {
                    return "Error: " . $result['message'];
                }
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }


    }
}

