<?php


use App\Models\AcademicYear;
use App\Models\Message;
use App\Models\SchoolClass;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

if (!function_exists('sendSms')) {
    function sendSms($message, $phone_number, $name = null)
    {
        $getToken = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJmaXJzdF9rZXkiOiI2MTMzNyIsInNlY29uZF9rZXkiOiIzNDk5NTM1IiwiaXNzdWVkQXQiOiIwOC0wMy0yMDI0IDA5OjQ1OjE3IiwidHRsIjo2MzA3MjAwMH0.tmeGW4_aP57titk5aca-U-5j32Jod_-s9TtYh_lQGpg";

        if ($getToken) {
            $url = "https://019sms.co.il/api";

            try {

                Message::create([
                    'message' => $message,
                    'phone' => $phone_number,
                    'name' => $name,
                    'added_by' => auth()->id(),
                ]);

                $response = Http::withToken($getToken)->post($url, [
                    'sms' => [
                        'user' => ['username' => env('SMS_019_USERNAME', 'riadmajd')],
                        'source' => env('SMS_019_PHONE', '026654099'),
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

        foreach ($phone_numbers as $data) {
            $phones[] = ['_' => $data['phone']];

            Message::create([
                'message' => $message,
                'phone' => $data['phone'],
                'name' => $data['name'],
                'added_by' => auth()->id(),
            ]);
        }


        if ($getToken) {
            $url = "https://019sms.co.il/api";

            try {
                $response = Http::withToken($getToken)->post($url, [
                    'sms' => [
                        'user' => ['username' => env('SMS_019_USERNAME', 'riadmajd')],
                        'source' => env('SMS_019_PHONE', '026654099'),
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

if (!function_exists('getUserActiveAcademicYearID')) {
    function getUserActiveAcademicYearID()
    {
        return Session::get('activeAcademicYear')->id;
    }
}

if (!function_exists('getAdminActiveAcademicYearID')) {
    function getAdminActiveAcademicYearID()
    {
        return AcademicYear::where('status', true)->get()->first()?->id;
    }
}

if (!function_exists('sendNotification')) {
    function sendNotification($deviceToken, $title, $body)
    {
        if ($deviceToken) {
            try {
                $factory = (new Factory)->withServiceAccount(public_path('firebase-configuration.json'));
                $messaging = $factory->createMessaging();
                $message = CloudMessage::withTarget('token', $deviceToken)->withNotification(['title' => $title, 'body' => $body])->withDefaultSounds();

                $messaging->send($message);
                return $message;
            } catch (NotFound $exception) {
                return 'Device Token Not Found .';
            }
        } else {
            return 'Device Token is empty .';
        }
    }
}

if (!function_exists('sendNotificationToGroup')) {
    function sendNotification($group, $title, $body)
    {
        if ($group) {
            try {
                $factory = (new Factory)->withServiceAccount(public_path('firebase-configuration.json'));
                $messaging = $factory->createMessaging();
                $message = CloudMessage::withTarget('token', $group)->withNotification(['title' => $title, 'body' => $body])->withDefaultSounds();

                $messaging->send($message);
                return $message;
            } catch (NotFound $exception) {
                return 'Device Token Not Found .';
            }
        } else {
            return 'Device Token is empty .';
        }
    }
}

