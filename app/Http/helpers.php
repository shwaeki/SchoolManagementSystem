<?php


if (!function_exists('sendSms')) {
    function sendSms($message, $phone_number)
    {
        $getToken = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJmaXJzdF9rZXkiOiI2MTMzNyIsInNlY29uZF9rZXkiOiIzNDk5NTM1IiwiaXNzdWVkQXQiOiIxMC0wMS0yMDI0IDEyOjM3OjM0IiwidHRsIjo2MzA3MjAwMH0.8Y1xEd7uP0C6rYJieX--stlpQ5l-VsEmUv_kCxfQLNs";

        if ($getToken) {
            $url = "https://019sms.co.il/api";

            try {
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
