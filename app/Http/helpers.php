<?php


use App\Models\Message;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Http;

if (!function_exists('sendSms')) {
    function sendSms($message, $phone_number)
    {
        $getToken = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJmaXJzdF9rZXkiOiI2MTMzNyIsInNlY29uZF9rZXkiOiIzNDk5NTM1IiwiaXNzdWVkQXQiOiIwOC0wMy0yMDI0IDA5OjQ1OjE3IiwidHRsIjo2MzA3MjAwMH0.tmeGW4_aP57titk5aca-U-5j32Jod_-s9TtYh_lQGpg";

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
                        'user' => ['username' => env('SMS_019_USERNAME','riadmajd')],
                        'source' => env('SMS_019_PHONE','026654099'),
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
        $getToken = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJmaXJzdF9rZXkiOiI2MTMzNyIsInNlY29uZF9rZXkiOiIzNDk5NTM1IiwiaXNzdWVkQXQiOiIwOC0wMy0yMDI0IDA5OjQ1OjE3IiwidHRsIjo2MzA3MjAwMH0.tmeGW4_aP57titk5aca-U-5j32Jod_-s9TtYh_lQGpg";


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
                        'user' => ['username' => env('SMS_019_USERNAME','riadmajd')],
                        'source' => env('SMS_019_PHONE','026654099'),
                        'destinations' => [
                            'phone' => $phones,
                        ],
                        'message' => $message,
                    ],
                ]);


                $result = $response->json();

               // dd(env('SMS_019_USERNAME'), env('SMS_019_PHONE'), $result);
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

